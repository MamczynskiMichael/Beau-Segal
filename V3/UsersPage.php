<?php
function imagePost(){
	$username = $_SESSION['UserLogedIn'];
	include "dbUpload.php";

	$sql = "SELECT * FROM images WHERE user='$username' ORDER BY orderImage DESC;";
	$stmt = mysqli_stmt_init($dbConnection);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "sql statement failed P";
	} else {
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		//If user hasn't posted anything is stays true
		//if they post it turns false
		$noPost = true;
		while ($row = mysqli_fetch_assoc($result)) {
			
			if ($noPost == true) {
				echo '
				<h1 class="text-center lead">Here is everything you have ever posted</h1>
				';
				$noPost = false;
			}
			echo '		
				<div id="frontPagePost" class="row w-75 text-break">
					<a href="InfocusPost.php?a='.$username.'&p='.$row['imgFullName'].'" class="text-decoration-none">  
						<img class="w-75 py-2 lozad rounded-3" src="Users/'.$username.'/'.$row["imgFullName"].'";>
						<h3>'.$row["titleImage"].'</h3>';
						if (!empty($row["descImage"])) {
							echo '<p>'.$row["descImage"].'</p>';
						}
			echo '
					</a>
				</div>
				';
			
		}
		if ($noPost == true){
			echo '
			<h1 class="text-center lead">You have not posted anything</h1>';

		}
		//This end div closes both noPosts and posts
		echo "</div>";
	}
}





//This adds the highlight for profile on the nav
function activePage() {
	echo "active";
}


?>