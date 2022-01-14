<?php
include('../db/db_connection.php')

function checkNumberOfPlayers(){
	global $conn;
	
	$sql="SELECT COUNT(pid) as Players FROM lobby"
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_all(); 
		if ($row>=2 $$ $row=<4){
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
		$sql = "SELECT pid, pname FROM lobby"
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()) {
			$element = array("{$row['user_id']}" => "{$row['username']}");
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