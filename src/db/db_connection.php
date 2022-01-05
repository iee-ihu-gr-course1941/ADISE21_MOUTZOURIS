<?php
$host = 'localhost';
$db = 'moutzouris';
require_once "db_password.php";

$user = $DB_USER;
$pass = $DB_PASS;

if (gethostname() == 'users.iee.ihu.gr') {
    $conn = new mysqli($host, $user, $pass, $db, null, '/home/student/it/2017/it174916/mysql/run/mysql.sock');
} else {
    $conn = new mysqli($host, $user, '', $db);
}

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" .
        $conn->connect_errno . ") " . $conn->connect_error;
}
?>