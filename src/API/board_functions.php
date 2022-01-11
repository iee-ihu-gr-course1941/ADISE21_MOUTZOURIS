<?php
include ('../db/db_connection.php');


function shuffleCards() {

	global $conn;
	$sql = "INSERT INTO game_cards SELECT * FROM cards ORDER BY RAND();"
	mysqli_query($conn,$sql);	
}


function dealCards($number_of_players) {

	global $conn;
	$sql = "UPDATE game_cards SET Player='$_SESSION['user_id']' WHERE Player=NULL LIMIT 42 DIV $number_of_players";
	mysqli_query($conn,$sql);
}


function getGameCards() {

	global $conn;
		
		$hand = array();
		$sql = "SELECT number,symbol FROM game_cards WHERE player='$_SESSION['user_id']'"
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
			$card = array("{$row['symbol']}" => "{$row['number']}");
			array_push($hand,$card);
		}
		return $hand;	
}


function takeCard($from, $to) {

	global $conn;
	$sql = "UPDATE game_cards SET Player=$to WHERE Player=$from ORDER BY RAND() LIMIT 1";
	mysqli_query($conn,$sql);
}


function discardDuplicate($player) {
	
	global $conn;
	$sql = "DELETE FROM game_cards WHERE Player=$player AND COUNT(Number)=2";
	mysqli_query($conn,$sql);
}


function endTurn($player,$number_of_players) {

	global $conn;
	
	$sql = "SELECT pid,position FROM lobby";
	$result = mysqli_query($conn,$sql);
	$check = $result->fetch_assoc();
	while($check<=
	$sql = "UPDATE game_status SET p_turn='$_SESSION['user_id']'";
	mysqli_query($conn,$sql);	
}


function endGame() {
	
	global $conn;
	$sql = "SELECT status FROM game_status WHERE status='ended'";
	$result = mysqli_query($conn,$sql);
	$check = $result->fetch_assoc();
	if (!empty($check)) {
		return $check['status'];
	}
	else {
		return 'null';
	}
}

function deadlock() {
	
	global $conn;
	$sql = "CALL deadlock()";
	endGame();
}

?>