<?php

require 'checkUserLoged.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SESSION['UserLogedIn'] != 'admin') {
	echo "Access denied";
	die();
	} 
	if (isset($_POST['accountIpBan'])) {
		$userBanned = $_POST['accountIpBan'];
		include "dbUpload.php";
		$sql = "SELECT remoteIP FROM users WHERE username='$userBanned'";
		$result = $dbConnection->query($sql);
		$row = $result->fetch_assoc();
		$selUserIP = $row['remoteIP'];
		$sql = "INSERT INTO bannedIP (username,ip,timeStamp) VALUES ('".$userBanned."','".$selUserIP."',NOW())";
		$stmt = mysqli_stmt_init($dbConnection);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "SQL connection didn't work IP ban";
			die();
		} 
		mysqli_stmt_execute($stmt);
		$dbConnection -> close();
	}


	if (isset($_POST['banThisDude']) || isset($userBanned)) {
		if (!isset($userBanned)) {
			$userBanned = $_POST['banThisDude'];
		}
		include "dbUpload.php";
		//Get the ending of the profile pic before we delete from the databse
		$sql = "SELECT `type` FROM `profilepic` WHERE user='".$userBanned."'";
		$stmt = mysqli_stmt_init($dbConnection);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "SQL connection didn't work banning";
			die(); 
			} else {
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$imageType = $row['type'];

			$sql = "SELECT `id` FROM `users` WHERE `username`='".$userBanned."'";
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "SQL connection didn't work banning";
			die(); 
			} else {
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$userBannedID = $row['id'];
				$sql = "DELETE FROM `votes` WHERE `userID` = '".$userBannedID."';";
				$sql .= "DELETE FROM `users` WHERE `username` = '".$userBanned."';";
				$sql .= "DELETE FROM `profilepic` WHERE `user` = '".$userBanned."';";
				$sql .= "DELETE FROM `images` WHERE `user` = '".$userBanned."';";
				$sql .= "DELETE FROM `comments` WHERE `user` = '".$userBanned."';";
				if (mysqli_multi_query($dbConnection, $sql)) {
				    do {
				        if ($result = mysqli_store_result($dbConnection)) {
				        }
				    } while (mysqli_next_result($dbConnection));
				}
				array_map('unlink', glob("Users/".$userBanned."/*.*"));
				rmdir('Users/'.$userBanned.'');
				array_map('unlink', glob("ProfilePictures/".$userBanned.$imageType));
				unset($_POST['banThisDude']);
				header('Location: admin.php?banSuccessful');
				}
			}	
		} else {
			echo "Left button removes account. Right button bans the IP along with account.<br>";


			include "dbUpload.php";
			$sql = "SELECT * FROM `users` WHERE NOT username='Admin'";
			$stmt = mysqli_stmt_init($dbConnection);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				echo "SQL connection didn't work";
				die(); 
				} else {
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$listOfUsers[] = $row['username'];
				}
				if (!empty($listOfUsers)) {
					for ($i=0; $i < sizeof($listOfUsers); $i++) { 
						echo "
			    		<form action='admin.php' method='post'>
			  			<input type='submit' value='".$listOfUsers[$i]."' name='banThisDude'>
			  			<label>Ip Ban</label>
			  			<input type='submit' value='".$listOfUsers[$i]."' name='accountIpBan'>	
						</form>
						";
					}
					echo "<a href='innercult.php'>innercult.php</a>";
				} else {
					echo "No Users Found";
				}
			}
		}
?>



