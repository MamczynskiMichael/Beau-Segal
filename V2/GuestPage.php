<?php
function imagePost(){

	//first we need  to see if the user account exists
	$username = $_SESSION['VAG'];
	include "dbUpload.php";

	$sql = "SELECT * FROM `users` WHERE username='".$username."'";
	$stmt = mysqli_stmt_init($dbConnection);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "sql statement failed searching user124";
		} else {
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);		
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if (empty($row['id'])) {
				header("Location: innercult.php?userDoesNotExist");
			}
				}
	//If the user is real then find their posts
	$sql = "SELECT * FROM images WHERE user='$username' ORDER BY orderImage DESC;";
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "sql statement failed";
	} else {
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		//If user hasn't posted anything stays true
		//if they post it turns false
		$noPost = true;
		while ($row = mysqli_fetch_assoc($result)) {
			
			if ($noPost == true) {
				echo '
				<div id="profileContainer" class="container text-center">
				<h1 class="text-center lead">Here is everything '.$username.' has ever posted</h1>
				';
				$noPost = false;
			}
			echo '		
				<div id="post">
					<a href="InfocusPost.php?a='.$username.'&p='.$row['imgFullName'].'" class="text-decoration-none">  
						<img class="postImg lozad" src="Users/'.$username.'/'.$row["imgFullName"].'";>
						<h3>'.$row["titleImage"].'</h3>
						<p>'.$row["descImage"].'</p>
					</a>
				</div>
				';
			
		}
		if ($noPost == true){
			echo '
			<div id="profileContainer" class="container text-center">
			<h1 class="text-center lead">'.$username.' has not posted anything</h1>';
		}
		//This end div closes both noPosts and posts
		echo "</div>";

	}
}
function follow(){
	
}
//This removes the highlight for profile on the nav
function activePage() {	
}
?>