CREATE DATABASE IF NOT EXISTS CS157B_PROJECT;
USE CS157B_PROJECT;

CREATE TABLE LEAGUE
(
  LeagueID INT NOT NULL AUTO_INCREMENT,
  LeagueName VARCHAR(50) NOT NULL,
  Country VARCHAR(50) NOT NULL,
  PRIMARY KEY (LeagueID)
);
CREATE TABLE TEAM
(
  TeamID INT NOT NULL AUTO_INCREMENT,
  TeamName VARCHAR(50) NOT NULL,
  City VARCHAR(50) NOT NULL,
  LeagueID INT NOT NULL,
  PRIMARY KEY (TeamID),
  FOREIGN KEY (LeagueID) REFERENCES LEAGUE(LeagueID)
);
CREATE TABLE PLAYER
(
  PlayerID INT NOT NULL AUTO_INCREMENT,
  FirstName VARCHAR(50) NOT NULL,
  LastName VARCHAR(50) NOT NULL,
  Nickname VARCHAR(50),
  Number INT NOT NULL,
  TeamID INT,
  PRIMARY KEY (PlayerID),
  FOREIGN KEY (TeamID) REFERENCES TEAM(TeamID)
);
CREATE TABLE MATCH_DETAILS
(
  MatchID INT NOT NULL AUTO_INCREMENT,
  Date DATE NOT NULL,
  LeagueID INT NOT NULL,
  PRIMARY KEY (MatchID),
  FOREIGN KEY (LeagueID) REFERENCES LEAGUE(LeagueID)
);
CREATE TABLE GOAL
(
  MinuteScored INT NOT NULL,
  SecondScored INT NOT NULL,
  TeamID INT NOT NULL,
  PlayerID INT NOT NULL,
  MatchID INT NOT NULL,
  PRIMARY KEY (MinuteScored, SecondScored, TeamID, PlayerID, MatchID),
  FOREIGN KEY (TeamID) REFERENCES TEAM(TeamID),
  FOREIGN KEY (PlayerID) REFERENCES PLAYER(PlayerID),
  FOREIGN KEY (MatchID) REFERENCES MATCH_DETAILS(MatchID)
);
CREATE TABLE PlaysIn
(
  IsHome BOOLEAN NOT NULL,
  TeamID INT NOT NULL,
  MatchID INT NOT NULL,
  PRIMARY KEY (TeamID, MatchID),
  FOREIGN KEY (TeamID) REFERENCES TEAM(TeamID),
  FOREIGN KEY (MatchID) REFERENCES MATCH_DETAILS(MatchID)
);
CREATE TABLE PLAYER_Position
(
  Position VARCHAR(50) NOT NULL,
  PlayerID INT NOT NULL,
  PRIMARY KEY (Position, PlayerID),
  FOREIGN KEY (PlayerID) REFERENCES PLAYER(PlayerID)
);


INSERT INTO league (LeagueName, Country) VALUES("Premier League", "England");
INSERT INTO league (LeagueName, Country) VALUES("La Liga", "Spain");
INSERT INTO league (LeagueName, Country) VALUES("Series A", "Italy");
INSERT INTO league (LeagueName, Country) VALUES("Bundesliga", "Germany");

INSERT INTO team (TeamName, City, LeagueID) VALUES("Manchester United", "Manchester", 1);
INSERT INTO team (TeamName, City, LeagueID) VALUES("Chelsea", "London", 1);
INSERT INTO team (TeamName, City, LeagueID) VALUES("Barcelona", "Barcelona", 2);
INSERT INTO team (TeamName, City, LeagueID) VALUES("Real Madrid", "Madrid", 2);
INSERT INTO team (TeamName, City, LeagueID) VALUES("Juventus","Turin", 3);
INSERT INTO team (TeamName, City, LeagueID) VALUES("AC Milan","Milan", 3);
INSERT INTO team (TeamName, City, LeagueID) VALUES("FC Bayern","Munich", 4);
INSERT INTO team (TeamName, City, LeagueID) VALUES("Dortmund","Dortmund", 4);


INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Paul", "Pogba", 6, 1);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Alexis", "Sanchez", 7, 1);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Eden", "Hazard", 10, 2);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("N'Golo", "KantÈ", 7, 2);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Lionel", "Messi", 10, 3);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Luis", "Suarez", 9, 3);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Cristiano", "Ronaldo", 7, 4);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Gareth", "Bale", 11, 4);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Gonzalo", "HiguaÌn", 9, 5);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Paulo", "Dybala", 10, 5);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Leonardo", "Bonucci", 19, 6);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Gianluigi", "Donnarumma", 99, 6);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Robert", "Lewandowski", 9, 7);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Arjen", "Robben", 10, 7);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Mario", "Gˆtze", 10, 8);
INSERT INTO player (FirstName, LastName, Number, TeamID) VALUES("Marco", "Reus", 11, 8);

INSERT INTO player_position (PlayerID, Position) VALUES(1, "CM");
INSERT INTO player_position (PlayerID, Position) VALUES(1, "CDM");
INSERT INTO player_position (PlayerID, Position) VALUES(2, "LW");
INSERT INTO player_position (PlayerID, Position) VALUES(2, "LM");
INSERT INTO player_position (PlayerID, Position) VALUES(2, "ST");
INSERT INTO player_position (PlayerID, Position) VALUES(3, "LW");
INSERT INTO player_position (PlayerID, Position) VALUES(4, "CDM");
INSERT INTO player_position (PlayerID, Position) VALUES(4, "CM");
INSERT INTO player_position (PlayerID, Position) VALUES(5, "CF");
INSERT INTO player_position (PlayerID, Position) VALUES(5, "ST");
INSERT INTO player_position (PlayerID, Position) VALUES(5, "RW");
INSERT INTO player_position (PlayerID, Position) VALUES(6, "ST");
INSERT INTO player_position (PlayerID, Position) VALUES(7, "LW");
INSERT INTO player_position (PlayerID, Position) VALUES(7, "ST");
INSERT INTO player_position (PlayerID, Position) VALUES(8, "RW");
INSERT INTO player_position (PlayerID, Position) VALUES(8, "ST");
INSERT INTO player_position (PlayerID, Position) VALUES(9, "ST");
INSERT INTO player_position (PlayerID, Position) VALUES(10, "CAM");
INSERT INTO player_position (PlayerID, Position) VALUES(10, "ST");
INSERT INTO player_position (PlayerID, Position) VALUES(11, "CB");
INSERT INTO player_position (PlayerID, Position) VALUES(12, "GK");
INSERT INTO player_position (PlayerID, Position) VALUES(13, "ST");
INSERT INTO player_position (PlayerID, Position) VALUES(14, "RM");
INSERT INTO player_position (PlayerID, Position) VALUES(14, "RW");
INSERT INTO player_position (PlayerID, Position) VALUES(15, "CM");
INSERT INTO player_position (PlayerID, Position) VALUES(15, "CF");
INSERT INTO player_position (PlayerID, Position) VALUES(15, "CAM");
INSERT INTO player_position (PlayerID, Position) VALUES(16, "LM");
INSERT INTO player_position (PlayerID, Position) VALUES(16, "ST");
INSERT INTO player_position (PlayerID, Position) VALUES(16, "LW");


INSERT INTO match_details (LeagueID, Date) VALUES(1, "2017-10-25");
INSERT INTO match_details (LeagueID, Date) VALUES(2, "2017-11-05");

INSERT INTO playsin (TeamID, MatchID, IsHome) VALUES(1, 1, 1);
INSERT INTO playsin (TeamID, MatchID, IsHome) VALUES(2, 1, 0);
INSERT INTO playsin (TeamID, MatchID, IsHome) VALUES(3, 2, 0);
INSERT INTO playsin (TeamID, MatchID, IsHome) VALUES(4, 2, 1);

INSERT INTO goal (MatchID, TeamID, PLayerID, MinuteScored, SecondScored) VALUES(1, 1, 1, 15, 51);
INSERT INTO goal (MatchID, TeamID, PLayerID, MinuteScored, SecondScored) VALUES(1, 1, 2, 35, 11);
INSERT INTO goal (MatchID, TeamID, PLayerID, MinuteScored, SecondScored) VALUES(1, 2, 3, 87, 9);
INSERT INTO goal (MatchID, TeamID, PLayerID, MinuteScored, SecondScored) VALUES(2, 3, 5, 10, 55);
INSERT INTO goal (MatchID, TeamID, PLayerID, MinuteScored, SecondScored) VALUES(2, 3, 5, 44, 15);
INSERT INTO goal (MatchID, TeamID, PLayerID, MinuteScored, SecondScored) VALUES(2, 3, 6, 60, 36);
INSERT INTO goal (MatchID, TeamID, PLayerID, MinuteScored, SecondScored) VALUES(2, 4, 7, 80, 19);
