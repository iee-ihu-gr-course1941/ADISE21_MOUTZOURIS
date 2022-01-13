<?php
session_start();
include "../db/db_connection.php";


if (empty(trim($_POST['username']))) {
	header("Location: ../HTML/index.php?error=Παρακαλώ συμπληρώστε το username");
	exit();
}

else if (empty(trim($_POST['password']))) {
	header("Location: ../HTML/index.php?error=Παρακαλώ συμπληρώστε το password");
	exit();
}

else {
	$username = $_POST['username'];
	$pass = $_POST['password'];
	echo "1o else";
	$sql="SELECT * FROM users WHERE username='$username'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result) == 0){
	echo "1o if"; 
		
		$sql = "INSERT INTO users VALUES (default,'$username','$pass')";
		$result=mysqli_query($conn,$sql);
	}
	
	$sql="SELECT * FROM users WHERE username='$username' AND password='$pass'";
	$result=mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) === 1) {
		echo "2o if"; 
		$_SESSION['username'] = $row['username'];
		$_SESSION['user_id'] = $row['id'];
		$uname = $_SESSION['username'];
		$id = $_SESSION['user_id'];
		$sql = "INSERT INTO lobby VALUES ('$id','$uname')";
		mysqli_query($conn,$sql);
		header("Location: ../HTML/lobby.php");
		exit();
	}
	else {
		$error="Λάθος username ή password";
		exit();
	}
}
?>