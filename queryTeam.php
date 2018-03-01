<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Team Query Results</title>
    <style>
    body
    {
        background-color: bisque
    }
    
    </style>
</head>

<body>
    <h1>Team Query Results</h1>
    <?php
        require('classes.php');
        
        function createTableRow(Team $t)
        {
            print "        <tr>\n";
            print "            <td>" . $t->getId()       . "</td>\n";
            print "            <td>" . $t->getName()     . "</td>\n";
            print "            <td>" . $t->getCity()     . "</td>\n";
            print "            <td>" . $t->getLeagueId() . "</td>\n";
            
            print "        </tr>\n";
        }
        
        $teamname = filter_input(INPUT_GET, "inputName");
        $teamcity = filter_input(INPUT_GET, "inputCity");
            
        try {
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=tngf",
                           "tngf", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);
                
            $query = "SELECT * FROM team";  
                
            // Fetch the matching database table rows.
            $data = $con->query($query);
            $data->setFetchMode(PDO::FETCH_CLASS, "Team");
                
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
            if ((strlen($teamname) > 0) && (strlen($teamcity) > 0)) {
                $query = "SELECT * FROM team ".
                         "WHERE teamname = :teamname".
                         "AND city = :teamcity";
                $ps = $con->prepare($query);
                $ps->bindParam(':teamname', $teamname);
                $ps->bindParam(':teamcity', $teamcity);
            }
            else if (strlen($teamname) > 0) {
                $query = "SELECT * FROM team ".
                         "WHERE teamname = :teamname";
                $ps = $con->prepare($query);
                $ps->bindParam(':teamname', $teamname);
            }
            else if (strlen($teamcity) > 0) {
                $query = "SELECT * FROM team ".
                         "WHERE city = :teamcity";
                $ps = $con->prepare($query);
                $ps->bindParam(':teamcity', $teamcity);
            }
            else {
                $ps = $con->prepare($query);
            }
        
            // Fetch the matching database table rows.
            $ps->execute();
            $ps->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Team");
            
            // Construct the HTML table row by row.
            while ($team = $ps->fetch()) {
                createTableRow($team);
            }
            
            print "    </table>\n";
        }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }        
    ?>
</body>
</html>
