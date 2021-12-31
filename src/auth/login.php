<?php
session_start();
include "./db/db_connection.php";

if (empty(trim($_POST['username']))) {
	header("Location: ./HTML/index.php?error=Παρακαλώ συμπληρώστε το username")
	exit();
}

else if (empty(trim($_POST['password'))) {
	header("Location: ./HTML/index.php?error=Παρακαλώ συμπληρώστε το password")
	exit();
}

else {
	$sql="SELECT * FROM users WHERE username='$username'";
	$result=mysqli_query($conn,$sql_u);
	if(mysqli_num_rows($result) == 0){			
		$sql = "INSERT INTO users VALUES (default,'$username','$pass')";
		$result=mysqli_query($conn,$sql);
	}
	
	$sql="SELECT * FROM users WHERE username='$username' AND password='$pass'";
	$result=mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) === 1) {
		$_SESSION['username'] = $row['username'];
		$_SESSION['user_id'] = $row['id'];
		header("Location: ./HTML/lobby.php");
		exit();
	}
	else {
		header("Location: ./HTML/index.php?error=Λάθος username ή password");
		exit();
	}
}
?>