<?php
include '../db/db_connection.php';

session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    if (isset($_SESSION['game_status']) && $_SESSION['game_status'] == 'started') {
        header('Location: ./board.php');
        exit();
    }
?>