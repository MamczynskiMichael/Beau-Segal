<?php 
session_start();
if (!empty($_POST['username']) || !empty($_POST['password'])) {
	
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
	include "dbUpload.php";
	include "getClientIP.php";
	$sql = "SELECT * FROM bannedIP WHERE ip='".getClientIP()."'";
	$result = $dbConnection->query($sql);
	if ($result->num_rows == 0 ){



	$sql = "SELECT username, password FROM `users` WHERE username='".$username."' AND BINARY password='".$password."'";
	$stmt = mysqli_stmt_init($dbConnection);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "sql statement failed creating account";
		} else {
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$dbConnection->close();
		if (!empty($row['username'])) {
			$_SESSION['UserLogedIn'] = $row['username'];
			unset($_SESSION['GuestLogedIn']);
			header("Location: innercult.php");
			exit();
		} else {
			$_SESSION['Error'] = 'Username Or Password Is Wrong';
			header("Location: login.php?UserPassWrong");
			exit();
		}
	}

	} else {
		$_SESSION['Error'] = 'The IP you are logging in from is banned';
		$dbConnection->close();
		header("Location: login.php?ipHasBeenBanned");
		exit();
	}

} else {
	$_SESSION['Error'] = 'Empty Fields';
	header("Location: login.php?emptyField");
	exit();
}
header("Location: index.php?ErrorOccurred");



 ?>













































 ?>