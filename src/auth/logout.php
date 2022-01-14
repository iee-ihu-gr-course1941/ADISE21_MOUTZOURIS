<?php
session_start();
include "../db/db_connection.php";

$uid = $_SESSION['user_id'];
$sql = "DELETE FROM lobby WHERE pid='$uid'";
mysqli_query($conn,$sql);
unset($_SESSION['user_id']);
unset($_SESSION['username']);
header("Location: ../HTML/index.php");

?>