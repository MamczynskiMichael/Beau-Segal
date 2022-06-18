<?php 
	session_start();
	unset($_SESSION["ValiERROR"]);
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS) ;
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS) ;

	#check if username or password is not long enough
		$lenUser = strlen($username);
		$lenPas = strlen($password);
		if ($lenUser < 1 || $lenPas < 1) {
			$_SESSION["ValiERROR"]['errorlen'] = true;
			header("Location: login.php");
			exit();
		}

	#If everything above is good then we connect to the database try to find user
	$serverName = "localhost";
	$dbAdminName = "root";
	$dbAdminPassword = "root";
	$dbName = "theboysjourneys";
	$dbConnection = new mysqli($serverName, $dbAdminName, $dbAdminPassword, $dbName);
	if ($dbConnection->connect_error) {
		die("Connection failed: " . $dbConnection->connect_error);}
	$sql = "SELECT username FROM `users` WHERE username='$username' ";
	$result = $dbConnection->query($sql);
	if ($result->num_rows > 0) {
	}
	else{
		$dbConnection->close();
		$_SESSION["ValiERROR"]['useNFo'] = true;
		header("Location: login.php");
		exit();
	}
	$sql = "SELECT password FROM `users` WHERE password='$password' ";
	$result = $dbConnection->query($sql);
	if ($result->num_rows > 0) {
		$_SESSION['UserLogedIn'] = $username;
		header("Location: index.php");
		exit();
	}
	else{
		$dbConnection->close();
		$_SESSION["ValiERROR"]['useNFo'] = true;
		header("Location: login.php");
		exit();
	}
	
 ?>













































 ?>