<?php

session_start();
 
// έλεγχος εάν ο χρήστης είναι ήδη συνδεδεμένος, αν ναι εμφάνιση της αρχικής σελίδας
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 

require_once "db_connection.php";
 
// δήλωση μεταβλητών με κενές αρχικές τιμές
$username = $password = "";
$username_err = $password_err = $login_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // έλεγχος αν το username ειναι κενό
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    
    // έλεγχος αν το password ειναι κενό
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Επικύρωση των στοιχείων
    if(empty($username_err) && empty($password_err)){
        
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // ανάθεση μεταβλητών
            $param_username = $username;
            
            // ελέγχει εάν εκτελείτε το statement
            if(mysqli_stmt_execute($stmt)){
                // αποθηκεύει το αποτέλεσμα
                mysqli_stmt_store_result($stmt);
                
                // έλεγχος αν το username υπάρχει, αν ναι επαληθεύει το password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Σωστός κωδικός, ξεκινάει καινουργιο session
                            session_start();
                            
                            // αποθήκευση στοιχείων σε μεταβλητές του session 
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // μεταφορά του χρήστη στην αρχική σελίδα
                            header("location: welcome.php");
                        } else{
                            // Το password δεν ειναι σωστό, εμφάνιση λάθους
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Το username δεν υπάρχει, εμφάνιση λάθους
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Κλείσιμο statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Κλείσιμο σύνδεσης
    mysqli_close($conn);
}
?>

<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" href="assets/poker_chip.png" >
    <meta charset="utf-8">
    <title>Login</title>

 
 <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form>
	<img class="mb-4" src="../assets/poker_chip.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Εισάγετε στοιχεία </h1>
	
	<?php 
        if(!empty($login_err)){
            echo <div class="alert alert-danger"> . $login_err . </div>;
        }        
        ?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
      
	<div class="form-floating">
	  <input type="text" id="floatingInput" placeholder="Όνομα χρήστη" <?php 
	  echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
		<span class="invalid-feedback"><?php echo $username_err; ?></span>
	</div>
    
	
	<div class="form-floating">
      <input type="password" id="floatingPassword" placeholder="Κωδίκος"<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
	  <span class="invalid-feedback"><?php echo $password_err; ?></span>
    </div>

    <button type="submit">Σύνδεση</button>
    <p>&copy; 2021-2022</p>
  </form>
</main>


    
  </body>
</html>
