DROP DATABASE IF EXISTS moutzouris;
CREATE DATABASE moutzouris;
USE moutzouris;
DROP TABLE IF EXISTS lobby;
DROP TABLE IF EXISTS cards;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS game_status;
DROP TABLE IF EXISTS game_cards;



CREATE TABLE cards (
  Number varchar(2) NOT NULL,
  Symbol varchar(1) NOT NULL,
  Player tinyint(2) DEFAULT NULL
);

CREATE TABLE game_cards (
  Number varchar(2) NOT NULL,
  Symbol varchar(1) NOT NULL,
  Player tinyint(2) DEFAULT NULL
);
  
CREATE TABLE game_status (
  status enum('not active','initialized','started','ended','aborded') NOT NULL DEFAULT 'not active',
  p_turn enum('1','2','3','4') DEFAULT '1',
  result enum('1','2','3','4') DEFAULT NULL,
  last_change timestamp NULL DEFAULT NULL
);

CREATE TABLE users (
  id tinyint(2) NOT NULL AUTO_INCREMENT,
  username varchar(20) DEFAULT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE lobby (
	pid tinyint(2) NOT NULL,
	pname varchar(20) DEFAULT NULL,
	position tinyint(1) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (position)
);

INSERT INTO cards VALUES ('1','C',NULL),('2','C',NULL),('3','C',NULL),('4','C',NULL),('5','C',NULL),('6','C',NULL),('7','C',NULL),('8','C',NULL),('9','C',NULL),('10','C',NULL),('13','C',NULL),('1','D',NULL),('2','D',NULL),('3','D',NULL),('4','D',NULL),('5','D',NULL),('6','D',NULL),('7','D',NULL),('8','D',NULL),('9','D',NULL),('10','D',NULL),('1','H',NULL),('2','H',NULL),('3','H',NULL),('4','H',NULL),('5','H',NULL),('6','H',NULL),('7','H',NULL),('8','H',NULL),('9','H',NULL),('10','H',NULL),('1','S',NULL),('2','S',NULL),('3','S',NULL),('4','S',NULL),('5','S',NULL),('6','S',NULL),('7','S',NULL),('8','S',NULL),('9','S',NULL),('10','S',NULL);

INSERT INTO users VALUES (default,'Alex','2310'),(default,'Miltos','lolo');



DELIMITER //
CREATE PROCEDURE clear_board ()
BEGIN
UPDATE game_status set status='not active', p_turn=null, result=null;
DROP TABLE IF EXISTS game_cards;
END //

DELIMITER ;


DELIMITER //
CREATE PROCEDURE deadlock ()
BEGIN
IF (SELECT count(*) FROM game_cards)=1 THEN
	SELECT Player FROM game_cards WHERE Player=@p;
	UPDATE game_status SET status='ended', p_turn=NULL, result=@p, last_change=CURRENT_TIMESTAMP;
END IF;
END //

DELIMITER ;