<?php 
session_start();
if (!empty($_POST['username']) || !empty($_POST['password']) || !empty($_POST['passwordVal'])) {
	
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
$passwordValidation = filter_input(INPUT_POST, 'passwordVal',  FILTER_SANITIZE_SPECIAL_CHARS);
//Don't want to feed excess characters
$orginalUsername = $_POST['username'];
$orginalPassword = $_POST['password'];
$lenUser = strlen($orginalUsername);
$lenPas = strlen($orginalPassword);


if (strtolower($username) == "default" || strtolower($username) == "Admin") {
	$_SESSION['Error'] = 'Invalid';
	header("Location: register.php");
	exit();
} else if ($lenUser < 7 || $lenPas < 7) {
	$_SESSION['Error'] = 'Username and/or Password too short';
	header("Location: register.php?userPassTooShort");
	exit();
	} else if (preg_match_all('/[A-Z]/', $password) === 0) {
		$_SESSION['Error'] = 'Password Needs At Least 1 Capital Letter';
		header("Location: register.php?noCapFound");
		exit();
		} else 	if ($password != $passwordValidation) {
			$_SESSION['Error'] = 'Passwords Not The Same';
			header("Location: register.php?passNotSame");
			exit();
			} else if ($lenUser > 25) {
				$_SESSION['Error'] = 'Username Must Be Less Than 25 Characters';
				header("Location: register.php?nameTooLong");
				exit();
				} else if (preg_match('/\s/',$username) > 0 || preg_match('/\s/',$password) > 0) {
					$_SESSION['Error'] = 'Spaces Not Allowed';
					header("Location: register.php?spacesNotAllowed");
					exit();
					}	 
					else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username)) {
						$_SESSION['Error'] = 'Invalid';
						header("Location: register.php");
						exit();
						} {
							include "dbUpload.php";
							$sql = "SELECT username FROM `users` WHERE username='".$username."'";
							$stmt = mysqli_stmt_init($dbConnection);
							if (!mysqli_stmt_prepare($stmt,$sql)) {
								echo "sql statement failed creating account";
								} else {
									mysqli_stmt_execute($stmt);
									$result = mysqli_stmt_get_result($stmt);
									$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
									if (empty($row['username'])) {
										include "getClientIP.php";
										$sql = "SELECT * FROM bannedIP WHERE ip='".getClientIP()."'";
										$result = $dbConnection->query($sql);
										if ($result->num_rows == 0 ){

										$sql = "INSERT INTO users (username,password,remoteIP) VALUES ('".$username."','".$password."','".getClientIP()."')";
										if (!mysqli_stmt_prepare($stmt,$sql)) {
											echo "sql statment failed creating account 2";
										} else {
											mysqli_stmt_execute($stmt);
											$defaultType = '.png';
											$setStatus = 0;
											$sql = "INSERT INTO profilepic (user,type,status) VALUES ('".$username."','".$defaultType."','".$setStatus."')";
											if (!mysqli_stmt_prepare($stmt,$sql)) {
												echo "sql statment failed creating account 3";
											} else{
												mysqli_stmt_execute($stmt);
												mkdir('Users/'.$username, 0777, true);
												$_SESSION['UserLogedIn'] = $username;
												$dbConnection->close();
												unset($_SESSION['GuestLogedIn']);
												header("Location: index.php?successfullyCreatedAccount");
											}
										}
									} else {
										$_SESSION['Error'] = 'This IP has been banned';
										$dbConnection->close();
										header("Location: register.php?ipHasBeenBanned");
										exit();
									}
								} else {
											$_SESSION['Error'] = 'Username Taken';
											$dbConnection->close();
											header("Location: register.php?usernameTaken");
											exit();
									}
		}
	}
} else {
	$_SESSION['Error'] = 'Empty Fields';
	header("Location: register.php?emptyField");
	exit();
}
 ?>