<?php
include('../db/db_connection.php')

function checkNumberOfPlayers(){
	global $conn;
	
	$sql="SELECT COUNT(pid) FROM lobby";
	$result = mysqli_query($conn, $sql);
	if($result>=2 && $result=<4) {
			return 'TRUE';
			//lock button "ΕΝΑΡΞΗ"
		}
		else {
			return 'FALSE';
		//unlock button "ΕΝΑΡΞΗ"
		}
}

function getLobby(){
		global $conn;
		
		$lobby = array();
		$sql = "SELECT pid, pname FROM lobby";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
			$element = array("{$row['pid']}" => "{$row['pname']}");
			array_push($lobby,$element);
		}
		return $lobby;
}

function StartGame(){
	global $conn;
	$sql= "UPDATE game_status SET status = 'started',last_change = CURRENT TIMESTAMP, p_turn="$_SESSION['user_id']"";
	mysqli_query($conn, $sql);
	
}
?>