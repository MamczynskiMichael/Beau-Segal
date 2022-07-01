<?php 

//work on changing it to take to photo to the folder profilepictures but check if the status. Make all statuses default to 0 maybe when creating a profile. Or create the DB row when making a profile pic. This might not work because it would be null. set it to 1 if they got a pic. If the profile is null then use default image or none at all. When you check status add the photo to the folder and address it the persons name CHANGE THE DB TO MAKE THE USERID TO THE USERSNAME. make sure to replace the files when making another profile pic.


if (isset($_POST['submit'])) {
	include "checkUserLoged.php";
	include 'validateVAG.php';
	$username = $_SESSION['UserLogedIn'];
	$file = $_FILES['userPostProImg'];

	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowed = array('jpg', 'jpeg', 'png');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0){
			if ($fileSize < 5000000) {
				$fileNameNew = $username.'.'.$fileActualExt;
				$fileDestination = 'ProfilePictures/'.$fileNameNew;
				include "dbUpload.php";
			 
					$sql = "SELECT * FROM `profilepic`;";
					$stmt = mysqli_stmt_init($dbConnection);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
						echo "SQL connection Didn't work 1";
					} else {
						mysqli_stmt_execute($stmt);
						
						$sql = "SELECT * FROM profilepic WHERE user='$username'";
						if (!mysqli_stmt_prepare($stmt,$sql)) {
						echo "SQL connection Didn't work 2";
						die(); 
						} else {
						mysqli_stmt_execute($stmt);

						$result = mysqli_stmt_get_result($stmt);
						$row = mysqli_fetch_array($result, MYSQLI_ASSOC);



						if ($row['status'] == 0) {
							$setStatus = 1;
							$sql = "UPDATE `profilepic` SET `status`=$setStatus, `type`='.$fileActualExt'";
							if (!mysqli_stmt_prepare($stmt,$sql)) {
								echo "SQL connection Didn't work 3";
								die(); 
								} else {
									mysqli_stmt_execute($stmt);

									move_uploaded_file($fileTmpName, $fileDestination);									
									header('Location: UsersProfile.php?Upload=Successful');

							} 
						} else {
							$sql = "UPDATE `profilepic` SET `type`='.$fileActualExt'";
							if (!mysqli_stmt_prepare($stmt,$sql)) {
								echo "SQL connection Didn't work 3";
								die(); 
								} else {
									//replaces all profile pictures
									for ($i=0; $i < sizeof($allowed); $i++) { 
										$fileName = 'ProfilePictures/'.$username.'.'.$allowed[$i];
										unlink(realpath($fileName));
									}

									mysqli_stmt_execute($stmt);

									move_uploaded_file($fileTmpName, $fileDestination);							
									header('Location: UsersProfile.php?Upload=Successful');
							}
						}
					}
				}
				
			} else {
				echo "Your file is too big";
			}
		} else {
			echo "There was an error uploading your image";
			var_dump($fileError);
		}
	} else {
		echo "You can not upload files of this type or have not submited a file";
	}
}

function displayProfInfo(){
	
	include "dbUpload.php";
	
	$username = $_SESSION['VAG'];
	
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
				<h3 class='mt-5'>".$username."</h3> 
				<a href='UsersProfile.php?a=$username'><img name='userPostProImg' id='profilePic' class='rounded-circle border border-secondary' src='ProfilePictures/Default.jpg'></a>";
				

				
			} else {
				$userProfilePic = $username . $row['type'];
				echo "
				<h3 class='mt-5'>".$username."</h3> 
				<a href='UsersProfile.php?a=$username'><img id='profilePic' class='rounded-circle border border-secondary' src='ProfilePictures/$userProfilePic'></a>";


			}
	}



//Display bio
	$sql = "SELECT `bio` FROM `users` WHERE username='".$username."';";
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "SQL connection didn't work bio display";
		die(); 
		} else {
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$usersBio = $row['bio'];
			if (!empty($usersBio)) {
				echo "
				<h4>Bio</h4>
				<p>$usersBio</p>";
			} else {
				echo "
				<h4>Bio</h4>
				<p>User has no bio</p>";
			}
		}
}

?>