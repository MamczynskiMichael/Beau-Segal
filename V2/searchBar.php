<?php
function searchBar(){
	echo "
	<div class='search-box'>
	  <input type='text' autocomplete='off' placeholder='Search A User or Post Title...'/>
	  <div class='result'></div>
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
			echo "<h2>Users:<h2>";
			$noUsernameFound = true; 
			for ($i = 0; $i < sizeof($sortedNameScores);$i++) {	
				if ($sortedNameScores[$i]["levscore"] <= $shortest) { 
						echo 
						'<a href="UsersProfile.php?a='.$sortedNameScores[$i]["name"].'">'.$sortedNameScores[$i]["name"].'</a><br>';						
				} else {
					if ($noUsernameFound == true) {
						echo "None Found";
					}
				}
				$noUsernameFound = false;
			}
			//Echo out the title that the algorithm found
			echo "<h2>Titles:<h2>";
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
									'<a href="InfocusPost.php?a='.$titleInfo['user'].'&p='.$titleInfo['imgFullName'].'">'.$sortedTitleScores[$i]["title"].'</a> By '.$titleInfo['user'].'<br>';
								$duplicateCheck = $sortedTitleScores[$i]["title"];								
							}
						}	
					}else {
						if ($noTitlesFound == true) {
							echo "None Found";
						}
					}
				}
			$noTitlesFound = false; 
			}			
	}
}
?>