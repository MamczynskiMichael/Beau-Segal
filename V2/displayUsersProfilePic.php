<?php
function displayProfilePic($username){
	include "dbUpload.php";

	$sql = "SELECT * FROM profilepic WHERE user='$username'";
	$stmt = mysqli_stmt_init($dbConnection);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "SQL connection Didn't work 2";
		die(); 
		} else {
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			if ($row['status'] == 0) {
				echo "
				<img id='profilePic' class='rounded-circle border border-secondary' src='ProfilePictures/Default.jpg'>
				<a class='d-inline' href='UsersProfile.php?a=".$username."'>".$username."</a>";	
			} else {
				$userProfilePic = $username . $row['type'];
				echo "
					<img id='profilePic' class='rounded-circle border border-secondary' src='ProfilePictures/$userProfilePic'>
					<a class='d-inline' href='UsersProfile.php?a=".$username."'>".$username."</a>";


			}
		}
}
?>