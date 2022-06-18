<?php
function searchBar(){
	echo "
	<div class='search-box'>
	  <input type='text' autocomplete='off' placeholder='Search A User or Post Title...'/>
	  <div class='result'></div>
	</div>
		";
	}
	//Connects to database pull names
	if(isset($_REQUEST["term"])){
		$enteredName = $_REQUEST["term"];
		if (!empty($enteredName)) {
			function getUsername () {
				include "dbUpload.php";   			
				$sql = "SELECT username FROM `users`;";
				$stmt = mysqli_stmt_init($dbConnection);
				if (!mysqli_stmt_prepare($stmt,$sql)) {
					echo "SQL connection Didn't work 1";
					} else {
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					$allUsers = array();
					
					while ($row = mysqli_fetch_assoc($result)) {

						$allUsers[] = $row['username'];
					}
				mysqli_close($dbConnection);
				return $allUsers;
			}

			
			// no shortest distance found, yet
			$shortest = -1;

			//set up the global multi array
			$scores = array();

			foreach ($allUsers as $word) {

			    // calculate the distance between the input word,
			    // and the current word
			    // and case sensativity
				$NenteredName = strtolower($enteredName);
				$Nword = strtolower($word);
				$lev = levenshtein($NenteredName, $Nword);
			    //create an array for the user and score
				$person = array(
				  'levscore' => $lev,
				  'name' => $word
				);
				//add array to list of all other users
			    array_push($scores,$person);
			}
				function val_sort($array,$key) {
					//Grab all the keys inside the scores(person) array and make an array
					foreach($array as $k=>$v) {
						$b[] = strtolower($v[$key]);
					}		
					//sort it low to high
					asort($b);

					//keep put all the values back with other key
					foreach ($b as $k=>$v) {
						$c[] = $array[$k];
					}	
					return $c;
				}
			$sortedScores = val_sort($scores, 'levscore');
			echo "<h2>Similar users:<h2>";
			$none = true; 
			for ($i = 0; $i < sizeof($sortedScores);$i++) {
				
				if ($sortedScores[$i]["levscore"] <= 4) { 
						echo 
						'<a href="UsersProfile.php?a='.$sortedScores[$i]["name"].'">'.$sortedScores[$i]["name"].'</a><br>';
				} else {
					if ($none == true) {
						echo "None ";

					}
				}
				$none = false;
			}
				
			function getTittleNames(){
				include "dbUpload.php";   
				$sql = "SELECT `user`, `titleImage`FROM `images`";
				$stmt = mysqli_stmt_init($dbConnection);
				if (!mysqli_stmt_prepare($stmt,$sql)) {
						echo "SQL connection Didn't work 2";
						} else {
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						$allTittles = array();
						
						while ($row = mysqli_fetch_assoc($result)) {
							$allTittles[] = $row['titleImage'];
							
						}
						mysqli_close($dbConnection);
						return $allTittles;
					}
				}
			
				$allTittles = getTittleNames();
		
				$shortest = -1;
				//set up the global multi array
				$scores = array();

				foreach ($allTittles as $word) {

				    // calculate the distance between the input word,
				    // and the current word
				    // and case sensativity
					$NenteredName = strtolower($enteredName);
					$Nword = strtolower($word);
					$lev = levenshtein($NenteredName, $Nword);
				    //create an array for the user and score
					$person = array(
					  'levscore' => $lev,
					  'tittle' => $word
					);
					//add array to list of all other users
				    array_push($scores,$person);
				}
				$sortedScores = val_sort($scores, 'levscore');
				echo "<h2>Similar tittles:<h2>";
				$duplicateCheck = null;
				$none = true; 
				for ($i = 0; $i < sizeof($sortedScores);$i++) {
					if ($duplicateCheck == $sortedScores[$i]["tittle"]) {
					} else {
						if ($sortedScores[$i]["levscore"] <= 4) {
								include "dbUpload.php";
								$sql = "SELECT `user` ,`imgFullName` FROM `images` WHERE titleImage='".$sortedScores[$i]["tittle"]."'";
								$stmt = mysqli_stmt_init($dbConnection);
								if (!mysqli_stmt_prepare($stmt,$sql)) {
									echo "SQL connection Didn't work 4";
									} else {
									mysqli_stmt_execute($stmt);
									$result = mysqli_stmt_get_result($stmt);
									$titleInfo = array();
									while ($row = mysqli_fetch_assoc($result)) {
									$titleInfo['user'] = $row['user'];	
									$titleInfo['imgFullName'] = $row['imgFullName'];	
									echo 
										'<a href="InfocusPost.php?a='.$titleInfo['user'].'&p='.$titleInfo['imgFullName'].'">'.$sortedScores[$i]["tittle"].'</a> By '.$titleInfo['user'].'<br>';
									$duplicateCheck = $sortedScores[$i]["tittle"];
									
								}
							}	
						}else {
							if ($none == true) {
								echo "None ";
							}
						}
					}
				$none = false; 
				}	
			}
	}
}
?>