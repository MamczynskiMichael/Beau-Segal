<?php

function checkUserVoted(){
	//Get Users ID then idImage then check if they havent voted before. Returns userID, idImage, and vote
	$username = $_SESSION['UserLogedIn'];
	include "dbUpload.php";
	$sql = "SELECT `id` FROM `users` WHERE username='".$username."'";
	$stmt = mysqli_stmt_init($dbConnection);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "SQL connection didn't work voting";
		die(); 
	} else {
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result);
		$userID = $row['id'];

		$sql = "SELECT `idImage` FROM `images` WHERE `imgFullName`='".$_SESSION['PID']."';";
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "SQL connection didn't work voting 2";
		die(); 
		} else {
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$idImage = $row['idImage'];

			$sql = "SELECT `id`,`vote` FROM `votes` WHERE userID='".$userID."' AND idImage='".$idImage."'";
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				echo "SQL connection didn't work voting 3";
				die();
			} else {
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				
				if (isset($row['vote'])) {
					$voteInfo['vote'] = $row['vote'];
					$voteInfo['userID'] = $userID;
					$voteInfo['idImage'] = $idImage;

					return $voteInfo;

				} else {
					$voteInfo['vote'] = null;
					$voteInfo['userID'] = $userID;
					$voteInfo['idImage'] = $idImage;

					return $voteInfo;
				}
			}
		}
	}
}
if (isset($_POST['downvote']) || isset($_POST['upvote'])) {
	//Guest cannot vote
	include "guestValidation.php";
	redirectGuest();
	
	include "checkUserLoged.php";
	if (isset($_POST['downvote'])) {
		$vote = 0;
	} else {
		$vote = 1;
	}
	include "dbUpload.php";
	$stmt = mysqli_stmt_init($dbConnection);
	//voteInfo[vote/userID/idImage]
	$voteInfo = checkUserVoted();
	if (isset($voteInfo['vote'])) {
		if ($voteInfo['vote'] == $vote) {
			$sql = "DELETE FROM `votes` WHERE userID='".$voteInfo['userID']."' AND idImage='".$voteInfo['idImage']."'";
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				echo "SQL connection didn't work voting 4";
				die();
				} else {
					mysqli_stmt_execute($stmt);
					
					header("Location: InfocusPost.php?a=".$_SESSION['VAG']."&p=".$_SESSION['PID']."");
					die();
				}
			}
			$sql = "UPDATE `votes` SET `vote`='".$vote."' WHERE userID='".$voteInfo['userID']."' AND idImage='".$voteInfo['idImage']."'";
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				echo "SQL connection didn't work voting 4.2";
				die();
			} else {
				mysqli_stmt_execute($stmt);
				
				header("Location: InfocusPost.php?a=".$_SESSION['VAG']."&p=".$_SESSION['PID']."");
				die();
			}
	} else {
		$sql = "INSERT INTO votes (userID,vote,idImage) VALUES (?,?,?)";
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "SQL connection didn't work voting 4.3";
			die(); 
			} else {
				mysqli_stmt_bind_param($stmt,"iii",$voteInfo['userID'],$vote,$voteInfo['idImage']);
				mysqli_stmt_execute($stmt);
				
				header("Location: InfocusPost.php?a=".$_SESSION['VAG']."&p=".$_SESSION['PID']."");
		}
	}
}
?>