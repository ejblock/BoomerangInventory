<?php
include 'config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Start or resume session, and create: $_SESSION[] array
session_start(); 

if ( !empty($_POST)) { // if $_POST filled then process the form

	// initialize $_POST variables
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordhash = MD5($password);
		
	// verify the username/password
	$sql = "SELECT id, status FROM persons WHERE username = ? AND u_password = ? LIMIT 1";
	$q = $conn->prepare($sql);
	$q->bind_param("ss", $username, $passwordhash);
    $q->execute();
    $q->bind_result($id, $status);

	if($q->fetch()) { // if successful login set session variables
		$_SESSION['person_id'] = $id;
		$_SESSION['person_status'] = $status;
		header("Location: index.php");
		exit();
	}
	else { // otherwise go to login error page
		header("Location: login_error.html");
	}
}
// if $_POST NOT filled then display login form, below.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link rel="stylesheet" href="styles.css">
</head>

<body>
    <img src="logo.png" alt="Company Logo" width="500" height="250">
    <div class="container">

		<div class="span10 offset1">

			<div class="row">
				<h1>Login</h1>
			</div>

			<form class="form-horizontal" action="login.php" method="post">
								  
				<div class="control-group">
					<label class="control-label">Username</label>
					<div class="controls">
						<input name="username" type="text" required> 
					</div>	
				</div> 
				
				<div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
						<input name="password" type="password"  required> 
					</div>	
				</div> 

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Sign in</button>
				</div>
				
				
			</form>


		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->

  </body>
  
</html>