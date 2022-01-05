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
        <title>Board</title>
        <link rel="stylesheet" href="../css/board.css">
        <link rel="icon" type ="text/css" href="../../assets/poker_chip.png">
    </head>

    <body>
        <div class="top">
            <div class='current-user'>
                <h2 class="username">Χρήστης: <?php echo $_SESSION['username']; ?></h2>
                <button onclick="location.href = '../auth/logout.php';" id="logout-button" class="logout-button">Αποσύνδεση</button>
            </div>
        </div>
        <h1 class="titlos">Καλή επιτυχία</h1>
		<h1 class="kartes">Cards</h1>
        <div class="table">
            <table id="cards">
				<tr>
					<td>S10</td>
					<td>S10</td>
					<td>S10</td>
					<td>S10</td>
					<td>S10</td>
					<td>S10</td>
					<td>S10</td>
					<td>S10</td>
					<td>S10</td>
					<td>S10</td>
				</tr>
            </table>
        </div>
        <button id="take-card" onclick="startGame()" disabled> Πάρε Κάρτα </button>
		<p id='info'></p>
                  
    </body>
    <script src="../scripts/lobby.js"></script>

    </html>