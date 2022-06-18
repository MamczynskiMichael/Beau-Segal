<?php 
session_start();
	#resets session errors
	unset($_SESSION["ValiERROR"]);

	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS) ;
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS) ;
	$passwordVal = filter_input(INPUT_POST, 'passwordVal',  FILTER_SANITIZE_SPECIAL_CHARS);

	#check if username or password is not long enough
		$lenUser = strlen($username);
		$lenPas = strlen($password);
		if ($lenUser < 1 || $lenPas < 1) {
			$_SESSION["ValiERROR"]['errorlen'] = true;
			header("Location: register.php");
			exit();
		}
	#check if password has capital letter
		if (preg_match_all('/[A-Z]/', $username) === 0 || preg_match_all('/[A-Z]/', $password) === 0) {
			$_SESSION["ValiERROR"]['noCap'] = true;
			header("Location: register.php");
			exit();
		}
	#check if both passwords are the same
		if ($password != $passwordVal) {
			$_SESSION["ValiERROR"]['pasNSame'] = true;
			header("Location: register.php");
			exit();
		}
	#check if password is 7 or longer
		if ($lenPas < 7) {
			$_SESSION["ValiERROR"]['errorlenpas'] = true;
			header("Location: register.php");
			exit();
		}
	#check database if they username is taken
	$serverName = "localhost";
	$dbAdminName = "root";
	$dbAdminPassword = "root";
	$dbName = "theboysjourneys";
	$dbConnection = new mysqli($serverName, $dbAdminName, $dbAdminPassword, $dbName);
	if ($dbConnection->connect_error) {
		die("Connection failed: " . $dbConnection->connect_error);}
	$sql = "SELECT username FROM `users` WHERE username='$username'";
	$result = $dbConnection->query($sql);	
		if($result->num_rows > 0){
			$dbConnection->close();
			$_SESSION['ValiERROR']['namTake'] = true;
			header("Location: register.php");
			exit();
		}
	#If everything above is good then we connect to the database and put in there info
	if ($dbConnection->connect_error) {
		die("Connection failed: " . $dbConnection->connect_error);}
	$sql = "INSERT INTO users (username, password) VALUES ('$username','$password')";
	if ($dbConnection->query($sql)) {
		$_SESSION['UserLogedIn'] = $username;
	}
	$dbConnection->close();


header("Location: index.php");
 ?>