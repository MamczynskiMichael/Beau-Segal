<?php
if (isset($_POST['deletePost'])) {
include "checkUserLoged.php";
$username = $_SESSION['UserLogedIn'];
//Post ID
$focusedImg = $_SESSION['PID'];
include "dbUpload.php";
//Grab ImgID remove all comments remove img from database then from the folder
$sql = "SELECT `idImage` FROM `images` WHERE `imgFullName`='".$focusedImg."';";
$stmt = mysqli_stmt_init($dbConnection);
if (!mysqli_stmt_prepare($stmt,$sql)) {
	echo "sql statement failed";
	} else {
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($result);
	$idImage = $row['idImage'];

	$sql = "DELETE FROM `votes` WHERE `idImage`='".$idImage."'";
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "sql statement failed 1.5";
		} else {
			mysqli_stmt_execute($stmt);
			$sql = "DELETE FROM `comments` WHERE `idImage`='".$idImage."'";
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				echo "sql statement failed 2nd";
				} else {
				mysqli_stmt_execute($stmt);
				$sql = "DELETE FROM `images` WHERE user='".$username."' AND imgFullName='".$focusedImg."'";
				if (!mysqli_stmt_prepare($stmt,$sql)) {
					echo "sql statement failed 3rd";
					} else {
					mysqli_stmt_execute($stmt);

					array_map('unlink', glob("Users/".$username."/".$focusedImg.""));
					header("Location: UsersProfile.php?postDeleted");
				}
			}
		}
	}
}
if (isset($_POST['deleteComment'])) {
	$comment = explode('_', $_POST['comment'], -1);
	$comment = implode('', $comment);
	$comment = filter_var($comment, FILTER_SANITIZE_SPECIAL_CHARS);
	$timeStamp = explode('_', $_POST['comment']);
	$timeStamp = end($timeStamp);

	include "checkUserLoged.php";
	$username = $_SESSION['UserLogedIn'];
	//Post ID
	$focusedImg = $_SESSION['PID'];
	include "dbUpload.php";

	$sql = "SELECT `idImage` FROM `images` WHERE `imgFullName`='".$focusedImg."'";
	$stmt = mysqli_stmt_init($dbConnection);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "sql statement failed 1";
		} else {
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result);
		$idImage = $row['idImage'];

		$sql = "DELETE FROM `comments` WHERE `idImage`='".$idImage."' AND `user`='".$username."' AND `comment`='".$comment."' AND `timeStamp` = '".$timeStamp."'";
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "sql statement failed 2";
			} else {
			mysqli_stmt_execute($stmt);
			
			header("Location: InfocusPost.php?a=".$_SESSION['VAG']."&p=".$focusedImg."&commentDeleted");
		}
	} 
}

?>