<?php
class Player {
    private $PlayerID;
    private $FirstName;
    private $LastName;
    private $Nickname;
    private $Number;
    private $TeamID;
    
    function __construct($id = NULL, $first = NULL, $last = NULL, 
                            $number = NULL, $team = NULL, $nickname = NULL) {
        $this->PlayerID = $id;
        $this->FirstName = $first;
        $this->LastName = $last;
        $this->Nickname = $nickname;
        $this->Number = $number;
        $this->TeamID = $team;
    }
    
    public function getId()             { return $this->PlayerID; }
    public function getFirstName()      { return $this->FirstName; }
    public function getLastName()       { return $this->LastName; }
    public function getNickName()       { return $this->Nickname; }
    public function getJerseyNumber()   { return $this->Number; }
    public function getTeamName()       { return $this->TeamID; }
    
}

class Team {
    private $TeamID;
    private $TeamName;
    private $City;
    private $LeagueID;
    
    function __construct($id = NULL, $name = NULL, $city = NULL, $league = NULL) {
        $this->TeamID = $id;
        $this->TeamName = $name;
        $this->City = $city;
        $this->LeagueID = $league;
    }
    
    public function getId()             { return $this->TeamID; }
    public function getName()           { return $this->TeamName; }
    public function getCity()           { return $this->City; }
    public function getLeagueName()     { return $this->LeagueID; }

}

class League {
    private $LeagueID; // Make sure variable name exactly matches the column name
    private $LeagueName; 
    private $Country;
    
    function __construct($id = NULL, $name = NULL, $ctry = NULL) {
        $this->LeagueID = $id;
        $this->LeagueName = $name;
        $this->Country = $ctry;
    }
    
    public function getId()             { return $this->LeagueID; }
    public function getName()           { return $this->LeagueName; }
    public function getCountry()        { return $this->Country; }
}

?>
