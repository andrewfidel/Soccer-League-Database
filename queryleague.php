<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Query Results</title>
    <style>
    body
    {
        background-color: bisque
    }
    
    </style>
</head>

<body>
    <h1>Query Results</h1>
    <?php
        require('classes.php');
        
        $leaguename = filter_input(INPUT_GET, "inputName");
            
        try {
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=CS157B_PROJECT",
                           "root", "");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);
                
            $query = "SELECT * FROM league";  
                
            // Fetch the matching database table rows.
            $data = $con->query($query);
            $data->setFetchMode(PDO::FETCH_CLASS, "Leagues");
                
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
            if ((strlen($leaguename) > 0)) {
                $query = "SELECT * FROM league ".
                         "WHERE leaguename = :leaguename";
                $ps = $con->prepare($query);
                $ps->bindParam(':leaguename', $leaguename);
            }
            else {
                $ps = $con->prepare($query);
            }
        
            // Fetch the matching database table rows.
            $ps->execute();
            $ps->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "League");
            
            // Construct the HTML table row by row.
            while ($league = $ps->fetch()) {
                print "        <tr>\n";
                print "            <td>" . $league->getId()      . "</td>\n";
                print "            <td>" . $league->getName()    . "</td>\n";
                print "            <td>" . $league->getCountry() . "</td>\n";
                print "        </tr>\n";    
            }
            
            print "    </table>\n";
        }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }        
    ?>
</body>
</html>
