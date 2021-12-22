DROP TABLE IF EXISTS cards;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS game_status;
DROP TABLE IF EXISTS game_cards;

CREATE TABLE cards (
  Number tinyint(2) NOT NULL,
  Symbol varchar(1) NOT NULL,
  Player varchar(1) DEFAULT NULL
);

CREATE TABLE game_cards (
  Number tinyint(2) NOT NULL,
  Symbol varchar(1) NOT NULL,
  Player varchar(1) DEFAULT NULL
);
  
CREATE TABLE game_status (
  status enum('not active','initialized','started','ended','aborded') NOT NULL DEFAULT 'not active',
  p_turn enum('F','S') DEFAULT 'F',
  result enum('F','S') DEFAULT NULL,
  last_change timestamp NULL DEFAULT NULL
);

CREATE TABLE users (
  username varchar(20) DEFAULT NULL,
  player enum('F','S') NOT NULL,
  last_action timestamp NULL DEFAULT NULL,
  PRIMARY KEY (player)
);

INSERT INTO cards VALUES (1,'C',NULL),(2,'C',NULL),(3,'C',NULL),(4,'C',NULL),(5,'C',NULL),(6,'C',NULL),(7,'C',NULL),(8,'C',NULL),(9,'C',NULL),(10,'C',NULL),(13,'C',NULL),(1,'D',NULL),(2,'D',NULL),(3,'D',NULL),(4,'D',NULL),(5,'D',NULL),(6,'D',NULL),(7,'D',NULL),(8,'D',NULL),(9,'D',NULL),(10,'D',NULL),(1,'H',NULL),(2,'H',NULL),(3,'H',NULL),(4,'H',NULL),(5,'H',NULL),(6,'H',NULL),(7,'H',NULL),(8,'H',NULL),(9,'H',NULL),(10,'H',NULL),(1,'S',NULL),(2,'S',NULL),(3,'S',NULL),(4,'S',NULL),(5,'S',NULL),(6,'S',NULL),(7,'S',NULL),(8,'S',NULL),(9,'S',NULL),(10,'S',NULL);

INSERT INTO users VALUES ('Alex','F',NULL),('Miltos','S',NULL);



DELIMETER ;;
CREATE PROCEDURE clear_board()
BEGIN
UPDATE game_status set status='not active', p_turn=null, result=null;
DROP TABLE IF EXISTS game_cards;
END;;

DELIMETER;

DELIMITER ;;
CREATE PROCEDURE deal_cards()
BEGIN

CREATE TABLE game_cards LIKE cards;
INSERT INTO game_cards SELECT * FROM cards ORDER BY RAND();
UPDATE game_cards SET Player='F'
UPDATE game_cards SET Player='S' LIMIT 21;

END;;

DELIMITER ;

DELIMITER ;;
CREATE PROCEDURE take_card(p varchar(1), s varchar(1), n tinyint)
BEGIN

UPDATE game_cards SET Player=p WHERE Symbol=s AND Number=n;
UPDATE game_status SET p_turn=if(p='F','S','F'), last_change=CURRENT_TIMESTAMP;

END;;

DELIMITER ;

DELIMITER ;;
CREATE PROCEDURE remove_pairs()
BEGIN



END;;

DELIMITER ;

DELIMITER ;;
CREATE PROCEDURE deadlock()
BEGIN

IF (SELECT count(*) FROM game_cards WHERE Player='F' )=0 THEN
	UPDATE game_status SET status='ended', p_turn=NULL, result='F', last_change=CURRENT_TIMESTAMP;
ELSIF (SELECT count(*) FROM game_cards WHERE Player='S' )=0 THEN
	UPDATE game_status SET status='ended', p_turn=NULL, result='S', last_change=CURRENT_TIMESTAMP;
END IF;

END;;

DELIMITER ;
