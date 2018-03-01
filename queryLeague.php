<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>League Query Results</title>
    <style>
    body
    {
        background-color: bisque
    }
    
    </style>
</head>

<body>
    <h1>League Query Results</h1>
    <?php
        require('classes.php');
        
        function createTableRow(League $l)
        {
            print "        <tr>\n";
            print "            <td>" . $l->getId()      . "</td>\n";
            print "            <td>" . $l->getName()    . "</td>\n";
            print "            <td>" . $l->getCountry() . "</td>\n";
            print "        </tr>\n";
        }
        
        $leaguename = filter_input(INPUT_POST, "inputName");
        $country = filter_input(INPUT_POST, "inputCountry");
            
        try {
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=tngf",
                           "tngf", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);
                
            $query = "SELECT * FROM league";  
                
            // Fetch the matching database table rows.
            $data = $con->query($query);
            $data->setFetchMode(PDO::FETCH_CLASS, "League");
                
            // We're going to construct an HTML table.
            print "    <table border='1'>\n";

            // Fetch the database field names.
            $result = $con->query($query);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            
            // Construct the header row of the HTML table.
            print "            <tr>\n";
            foreach ($row as $field => $value) {
                    print "                <th>$field</th>\n";
            }
            print "            </tr>\n";

            // Constrain the query if 
            if ((strlen($leaguename) > 0) && (strlen($country) > 0)) {
                $query = "SELECT * FROM league ".
                         "WHERE leaguename = :leaguename ".
                         "AND country = :country";
                $ps = $con->prepare($query);
                $ps->bindParam(':leaguename', $leaguename);
                $ps->bindParam(':country', $country);
            }
            else if (strlen($leaguename) > 0) {
                $query = "SELECT * FROM league ".
                         "WHERE leaguename = :leaguename";
                $ps = $con->prepare($query);
                $ps->bindParam(':leaguename', $leaguename);
            }
            else if (strlen($country) > 0) {
                $query = "SELECT * FROM league ".
                         "WHERE country = :country";
                $ps = $con->prepare($query);
                $ps->bindParam(':country', $country);
            }
            else {
                $ps = $con->prepare($query);
            }
        
            // Fetch the matching database table rows.
            $ps->execute();
            $ps->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "League");
            
            // Construct the HTML table row by row.
            while ($league = $ps->fetch()) {
                createTableRow($league);
            }
            
            print "    </table>\n";
        }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }        
    ?>
</body>
</html>
