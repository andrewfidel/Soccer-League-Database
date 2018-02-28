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
    
    <p>
        <?php
            require('classes.php');
        
            //used for type hinting
            function createTableRow(Player $p) {
                print "             <tr>\n";
                print "                 <td>" . $p->getId()     . "</td>\n";
                print "                 <td>" . $p->getFirstName()  . "</td>\n";
                print "                 <td>" . $p->getLastName()   . "</td>\n";
                print "                 <td>" . $p->getNickName() . "</td>\n";
                print "                 <td>" . $p->getJerseyNumber() . "</td>\n";
                print "                 <td>" . $p->getTeamID() . "</td>\n";
                print "             </tr>\n";

            }
        
            $first = filter_input(INPUT_POST, "firstName");
            $last  = filter_input(INPUT_POST, "lastName");
            
            try {
                // Connect to the database.
                $con = new PDO("mysql:host=localhost;dbname=CS157B_PROJECT",
                               "root", "");
                $con->setAttribute(PDO::ATTR_ERRMODE,
                                   PDO::ERRMODE_EXCEPTION);
                
//                
//                $query = "SELECT player.PlayerID, player.FirstName, player.LastName, player.NickName, player.Number, ".
//                             "team.TeamName, league.LeagueName ".
//                             "FROM player, team, league ".
//                             "WHERE player.TeamID  = team.TeamID ".
//                             "AND   team.LeagueID  = league.LeagueID";
                
                $query = "SELECT * FROM player";
                
                //If both first name and last name are specified
                if (strlen($first) > 0 && strlen($last) > 0) {
                    $query = $query . " WHERE FirstName = :first".
                                        " AND LastName = :last";
                    $ps = $con->prepare($query);
                    $ps->bindParam(':first', $first);
                    $ps->bindParam(':last', $last);
                } else if (strlen($first) > 0) {    //if only first name is specified
                    $query = $query . " WHERE FirstName = :first";
                    $ps = $con->prepare($query);
                    $ps->bindParam(':first', $first);
                } else if (strlen($last) > 0) {     //if only last name is specified
                    $query = $query . " WHERE LastName = :last";
                    $ps = $con->prepare($query);
                    $ps->bindParam(':last', $last);
                } else {
                    $ps = $con->prepare($query);
                }
            
                
                // We're going to construct an HTML table.
                print "<table border='1'>\n";
                
                
                $ps->execute();
                $ps->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Player");

                //Print table header
                print "             <tr>\n";
                print "                 <th>" . "PlayerID"    . "</td>\n";
                print "                 <th>" . "FirstName"  . "</td>\n";
                print "                 <th>" . "LastName"   . "</td>\n";
                print "                 <th>" . "NickName" . "</td>\n";
                print "                 <th>" . "JerseyNumber" . "</td>\n";
                print "                 <th>" . "TeamID" . "</td>\n";
                print "             </tr>\n";
                
                // Construct the HTML table row by row.
                while ($player = $ps->fetch()) {
                    createTableRow($player); 
                }
                
                
                print "        </table>\n";
            }
            catch(PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
            }        
        ?>
    </p>
</body>
</html>