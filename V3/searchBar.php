<?php
function searchBar(){
	/*echo "
	<div class='container float-md-start'>
		<div class='row'>
			<div class='input-group input-group-sm mb-3 search-box'>
				<input type='text' class='form-control' aria-label='Search A User or Post Title...' aria-describedby='inputGroup-sizing-sm'>
			<div class='result text-wrap'>
			</div>
			</div>
		</div>
	</div>
		";*/
	echo "
	<div class='d-flex search-box position-relative text-break'>
		<input type='text' class='form-control' placeholder='Search User or Post' aria-label='SearchUser' aria-describedby='inputGroup-sizing-sm'>
		<div class='result text-wrap position-fixed mt-5 p-3' style='visibility: hidden;'>
		</div>
	</div>
	";

	}
	//Terms are sent here and then to the database and then back here to be processed and sent back to the user.
	if(isset($_REQUEST["term"])){
		$enteredTerm = $_REQUEST["term"];
		if (!empty($enteredTerm)) {
			function getUsername () {
				include "dbUpload.php";   			
				$sql = "SELECT username FROM `users`;";
				$stmt = mysqli_stmt_init($dbConnection);
				if (!mysqli_stmt_prepare($stmt,$sql)) {
					echo "SQL connection Didn't work 1";
					} else {
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					mysqli_close($dbConnection);
					$allUsers = array();
					while ($row = mysqli_fetch_assoc($result)) {
						$allUsers[] = $row['username'];
					}
				return $allUsers;
				}
			}
			function getTitleNames(){
				include "dbUpload.php";   
				$sql = "SELECT titleImage FROM `images`";
				$stmt = mysqli_stmt_init($dbConnection);
				if (!mysqli_stmt_prepare($stmt,$sql)) {
						echo "SQL connection Didn't work 2";
						} else {
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						mysqli_close($dbConnection);
						$allTitles = array();
						while ($row = mysqli_fetch_assoc($result)) {
							$allTitles[] = $row['titleImage'];
						}
						return $allTitles;
					}
			}
			function val_sort($array,$key) {
					//Grab all the keys inside the scores(lev) array and make an array
					foreach($array as $k=>$v) {
						$b[] = strtolower($v[$key]);
					}		
					//sort it low to high
					asort($b);
					//using original array orderd by key ID
					foreach ($b as $k=>$v) {
						$c[] = $array[$k];
					}	
					return $c;
			}
			$allUsernames = getUsername();
			$allTitles = getTitleNames();
			//set up the global multi array
			$nameScores = array();
			$titleScores = array();
			foreach ($allUsernames as $username) {
			    // calculate the distance between the input word,
			    // and the database word removing capitals
				$lowerEnteredName = strtolower($enteredTerm);
				$lowerName = strtolower($username);
				$lev = levenshtein($lowerEnteredName, $lowerName);
			    //create an array for the user and score
				$levUsername = array(
				  'levscore' => $lev,
				  'name' => $username
				);
				//add array to list of all other users
			    array_push($nameScores, $levUsername);
			}
			foreach ($allTitles as $title) {
				$lowerEnteredTitle = strtolower($enteredTerm);
				$lowerTitle = strtolower($title);
				$lev = levenshtein($lowerEnteredTitle, $lowerTitle);
			    //create an array for the user and score
				$levTitle = array(
				  'levscore' => $lev,
				  'title' => $title
				);
				//add array to list of all other users
			    array_push($titleScores, $levTitle);
			}
			//sort the scores
			$sortedNameScores = val_sort($nameScores, 'levscore');
			$sortedTitleScores = val_sort($titleScores, 'levscore');
			// max ammount of incorrect characters 
			$shortest = 4;
			//Echo out the name that the algorithm found
			echo "<h2 class='ps-1 lead'>Users:</h2>";
			$noUsernameFound = true; 
			for ($i = 0; $i < sizeof($sortedNameScores);$i++) {	
				if ($sortedNameScores[$i]["levscore"] <= $shortest) { 
						echo 
						'<p class="fs-5 ps-1"><a href="UsersProfile.php?a='.$sortedNameScores[$i]["name"].'">'.$sortedNameScores[$i]["name"].'</a></p><br>';						
				} else {
					if ($noUsernameFound == true) {
						echo '<p class="fs-5 ps-1">None Found</p>';
					}
				}
				$noUsernameFound = false;
			}
			//Echo out the title that the algorithm found
			echo "<h2 class='ps-1 lead'>Titles:</h2>";
			$duplicateCheck = "";
			$noTitlesFound = true; 
			for ($i = 0; $i < sizeof($sortedTitleScores);$i++) {
				if ($duplicateCheck == $sortedTitleScores[$i]["title"]) {
				} else {
					if ($sortedTitleScores[$i]["levscore"] <= $shortest) {
							include "dbUpload.php";
							$sql = "SELECT `user` ,`imgFullName` FROM `images` WHERE titleImage='".$sortedTitleScores[$i]["title"]."'";
							$stmt = mysqli_stmt_init($dbConnection);
							if (!mysqli_stmt_prepare($stmt,$sql)) {
								echo "SQL connection Didn't work 4";
								} else {
								mysqli_stmt_execute($stmt);
								$result = mysqli_stmt_get_result($stmt);
								mysqli_close($dbConnection);
								$titleInfo = array();
								while ($row = mysqli_fetch_assoc($result)) {
								$titleInfo['user'] = $row['user'];	
								$titleInfo['imgFullName'] = $row['imgFullName'];	
								echo 
									'<p class="fs-5 ps-1"><a href="InfocusPost.php?a='.$titleInfo['user'].'&p='.$titleInfo['imgFullName'].'">'.$sortedTitleScores[$i]["title"].'</a> By '.$titleInfo['user'].'</p><br>';
								$duplicateCheck = $sortedTitleScores[$i]["title"];								
							}
						}	
					}else {
						if ($noTitlesFound == true) {
							echo '<p class="fs-5 ps-1">None Found</p>';
						}
					}
				}
			$noTitlesFound = false; 
			}			
	}
}
?>