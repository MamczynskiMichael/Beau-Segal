<?php 
if (isset($_POST['submit'])) {

	include "checkUserLoged.php";
	$username = $_SESSION['UserLogedIn'];


	//bio processing
	$bioText = filter_input(INPUT_POST, 'bioText', FILTER_SANITIZE_SPECIAL_CHARS);
	$bioLength = strlen($bioText);
	if ($bioLength != 0) {
		if ($bioLength >= 255) {
				header("Location: UsersProfile.php?failedBioToLong");
				exit();
		}
		include_once "dbUpload.php";
		$sql = "UPDATE `users` SET `bio`='".$bioText."' WHERE username='".$username."';";
		$stmt = mysqli_stmt_init($dbConnection);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "SQL connection Didn't work bio";
			die();
		} 
		mysqli_stmt_execute($stmt);
	}


	//profile pic processing
	$file = $_FILES['userPostProImg'];

	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowed = array('jpg', 'jpeg', 'png');
	if (!empty($fileName)) {
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
								$sql = "UPDATE `profilepic` SET `status`=$setStatus, `type`='.".$fileActualExt."' WHERE user='".$username."'";
								if (!mysqli_stmt_prepare($stmt,$sql)) {
									echo "SQL connection Didn't work 3";
									die(); 
									} else {
										mysqli_stmt_execute($stmt);

										move_uploaded_file($fileTmpName, $fileDestination);									
										header('Location: UsersProfile.php?Upload=Successful');

								} 
							} else {
								$sql = "UPDATE `profilepic` SET `type`='.".$fileActualExt."' WHERE user='$username'";
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

	header("Location: UsersProfile.php?UpdatedProfile");
}
function displayProfInfo(){
	//CODE FOR GETTING profile Img and displaying name

	include "dbUpload.php";
	
	$username = $_SESSION['UserLogedIn'];
	$sql = "SELECT * FROM profilepic WHERE user='".$username."'";
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
					<h3 id='VAGprofilename'>".$username."</h3>
					<img name='userPostProImg' id='usersprofilepic' class='rounded-circle border border-secondary' src='ProfilePictures/Default.jpg'>";
				

				
			} else {
				$userProfilePic = $username . $row['type'];
				echo "
					<h3 id='VAGprofilename'>".$username."</h3>
					<img id='usersprofilepic' class='rounded-circle border border-secondary' src='ProfilePictures/$userProfilePic'>";


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
				<p>Add your own</p>";
			}


	}
	// this creates the edit profile button and pop up         
	echo '
	<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#editprofile">Edit Profile</button>
	';
}
//HTML for the edit profile button
$editProfilModal = '
	<div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="editprofileLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editprofileLabel">Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="profilePic.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputGroup" name="userPostProImg">
              <label class="custom-file-label" for="inputGroup" aria-describedby="inputGroup">Select an profile image</label>
              <input type="text" class="form-control text-center mt-2" placeholder="Add A Bio" name="bioText">  
          </div>
          </div>  
          </div>         
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button  class="btn btn-primary" type="submit" name="submit">Save Changes</button>
           </form>
          </div>
        </div>
      </div>
    </div> ';
?>