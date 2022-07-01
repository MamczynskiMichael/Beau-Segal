<?php
if (isset($_POST['commentOnPost'])) {

	include "checkUserLoged.php";
	include "guestValidation.php";
	redirectGuest();
	include 'validateVAG.php';
	$username = $_SESSION['UserLogedIn'];

	$userComment = filter_input(INPUT_POST, 'commentOnPost', FILTER_SANITIZE_SPECIAL_CHARS);
	$commentLength = strlen($userComment);
	if ($commentLength != 0) {
		if ($commentLength >= 255) {
			
				header("Location: InfocusPost.php?p=".$_SESSION['PID']."?CommentToLong");
				exit();
		}
		include_once "dbUpload.php";

		//Get the datbase key for the image so we can connect comments with image databases.
		$sql = "SELECT `user`,`idImage` FROM `images` WHERE `imgFullName`='".$_SESSION['PID']."';";





		$stmt = mysqli_stmt_init($dbConnection);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "SQL connection didn't work commenting";
		die(); 
		} else {
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			$idImage = $row['idImage'];


		$sql = "INSERT INTO `comments`(`user`, `comment`, `idImage`, `timeStamp`) VALUES ('".$username."','".$userComment."','".$idImage."',NOW());";
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "SQL connection Didn't work commenting 2";
			die();
		} 
		mysqli_stmt_execute($stmt);
		
		header("Location: InfocusPost.php?a=".$_SESSION['VAG']."&p=".$_SESSION['PID']."");
		}
	} else {
		header("Location: InfocusPost.php?p=".$_SESSION['PID']);
		exit();
	}
}
?>