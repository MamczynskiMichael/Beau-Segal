<?php
if (isset($_SESSION['VAG'])) {
	include_once "dbUpload.php";
	$sql = "SELECT `username` FROM `users` WHERE username='".$_SESSION['VAG']."'";
	$stmt = mysqli_stmt_init($dbConnection);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "sql statement failed checking guest";
		die();
		} else {
		mysqli_stmt_execute($stmt);
	
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result);

		if (isset($row['username'])) {
			$_SESSION ['VAG'] = $row['username'];
		} else {
			
			header("Location: innercult.php?usernameNotFound");
			die();
		}
	}
}
?>