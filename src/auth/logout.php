<?php
session_start();
include "../db/db_connection.php";

unset($_SESSION["user_id"]);
unset($_SESSION["username"]);
$sql = "DELETE FROM lobby WHERE pid='$user_id'";
mysqli_query($conn,$sql);
header("Location: ../HTML/index.php");

?>