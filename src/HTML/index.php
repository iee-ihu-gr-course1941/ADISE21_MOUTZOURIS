<?php

session_start();
 
// έλεγχος εάν ο χρήστης είναι ήδη συνδεδεμένος, αν ναι εμφάνιση της αρχικής σελίδας
if(isset($_SESSION['user_id']) === true){
    header("Location: ./lobby.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<link rel="icon" type ="text/css" href="../../assets/poker_chip.png" >
    <meta charset="utf-8">
    <title>Login</title>
	<link href="../css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="../auth/login.php" method="post">
  
	<img class="mb-4" src="../../assets/poker_chip.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Εισάγετε στοιχεία </h1>
 
	<div class="form-floating">
	  <input type="text" name="username" id="floatingInput" placeholder="Όνομα χρήστη">
	</div>
    
	
	<div class="form-floating">
      <input type="password" name="password" id="floatingPassword" placeholder="Κωδίκος">
    </div>

    <button type="submit">Σύνδεση</button>
	<p class="info"><?php echo $_POST['error']; ?></p>
    <p>&copy; 2021-2022</p>
  </form>
</main>


    
  </body>
</html>