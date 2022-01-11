<?php
include '../db/db_connection.php';

session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    if (isset($_SESSION['game_status']) && $_SESSION['game_status'] == 'started') {
        header('Location: ./board.php');
        exit();
    }
?>


<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Lobby</title>
        <link rel="stylesheet" href="../css/lobby.css">
        <link rel="icon" type ="text/css" href="../../assets/poker_chip.png">
    </head>

    <body>
        <div class="top">
            <div class='current-user'>
                <h2 class="username">Χρήστης: <?php echo $_SESSION['username']; ?></h2>
                <button onclick="location.href = '../auth/logout.php';" id="logout-button" class="logout-button">Αποσύνδεση</button>
            </div>
        </div>
        <h1>Lobby</h1>
        <div class="table">
            <table id="lobby">
                <tr>
                    <th>ID Παίκτη</th>
                    <th>Username</th>
                </tr>
            </table>
        </div>
        <p id='info'>testtest</p>
        <button id="start" class='disabled' onclick="window.location.pathname = `${url}/HTML/board.php`;" disabled> Έναρξη </button>
                  
    </body>
    <script src="../scripts/lobby.js"></script>

    </html>