<?php
<<<<<<< HEAD
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
	
	$sql = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
	$result = mysqli_query($conn, $sql);
	
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
=======

session_start();
 
 //έλεγχος εάν ο χρήστης είναι ήδη συνδεδεμένος, αν ναι εμφάνιση της αρχικής σελίδας
if(isset($_SESSION[loggedin]) && $_SESSION[loggedin] === true){
    header(location welcome.php);
    exit;
}
 

require_once db_connection.php;
 
 //δήλωση μεταβλητών με κενές αρχικές τιμές
$username = $password = ;
$username_err = $password_err = $login_err = ;
 

if($_SERVER[REQUEST_METHOD] == POST){
 
     //έλεγχος αν το username ειναι κενό
    if(empty(trim($_POST[username]))){
        $username_err = Please enter username.;
    } else{
        $username = trim($_POST[username]);
    }

    
     //έλεγχος αν το password ειναι κενό
    if(empty(trim($_POST[password]))){
        $password_err = Please enter your password.;
    } else{
        $password = trim($_POST[password]);
    }
    
     //Επικύρωση των στοιχείων
    if(empty($username_err) && empty($password_err)){
        
        $sql = SELECT id, username, password FROM users WHERE username = ;
        
        if($stmt = mysqli_prepare($conn, $sql)){
            
            mysqli_stmt_bind_param($stmt, s, $param_username);
            
             //ανάθεση μεταβλητών
            $param_username = $username;
            
             //ελέγχει εάν εκτελείτε το statement
            if(mysqli_stmt_execute($stmt)){
                 //αποθηκεύει το αποτέλεσμα
                mysqli_stmt_store_result($stmt);
                
                 //έλεγχος αν το username υπάρχει, αν ναι επαληθεύει το password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                             //Σωστός κωδικός, ξεκινάει καινουργιο session
                            session_start();
                            
                             //αποθήκευση στοιχείων σε μεταβλητές του session 
                            $_SESSION[loggedin] = true;
                            $_SESSION[id] = $id;
                            $_SESSION[username] = $username;                            
                            
                             //μεταφορά του χρήστη στην αρχική σελίδα
                            header(location welcome.php);
                        } else{
                             //Το password δεν ειναι σωστό, εμφάνιση λάθους
                            $login_err = Invalid username or password.;
                        }
                    }
                } else{
                     //Το username δεν υπάρχει, εμφάνιση λάθους
                    $login_err = Invalid username or password.;
                }
            } else{
                echo Oops! Something went wrong. Please try again later.;
            }

             //Κλείσιμο statement
            mysqli_stmt_close($stmt);
        }
    }
    
     //Κλείσιμο σύνδεσης
    mysqli_close($conn);
}
?>
>>>>>>> 967f0d18c5f190494b926687a66c5ac3ecb41069
