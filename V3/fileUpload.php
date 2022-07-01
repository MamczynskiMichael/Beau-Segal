<?php
if (isset($_POST['submit'])) {
	include "checkUserLoged.php";
	include "guestValidation.php";
	redirectGuest();

	$imageTitle = filter_input(INPUT_POST, 'filetitle', FILTER_SANITIZE_SPECIAL_CHARS);
	$imageDesc = filter_input(INPUT_POST, 'filedesc', FILTER_SANITIZE_SPECIAL_CHARS);

	if (strlen($imageTitle) > 50) {
		$_SESSION['Error'] = 'Title exceeds 50 character limit';
		header('Location: AllWeHave.php?titleLongerThan50Characters');
		die();
	}

	if (strlen($imageTitle) < 5) {
		$_SESSION['Error'] = 'Title must contain at least 5 characters';
		header('Location: AllWeHave.php?tilteToShort5CharactersOrMore');
		die();
	}
	if (strlen($imageDesc) > 255) {
		$_SESSION['Error'] = 'Description is exceeding 255 character limit';
		header('Location: AllWeHave.php?descTooLong');
		die();
	}


	$file = $_FILES['userPostImg'];

	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowed = array('jpg', 'jpeg', 'png','gif');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 12000000) {
				$fileNameNew = uniqid('', true).'.'.$fileActualExt;
				$fileDestination = 'Users/'.$_SESSION['UserLogedIn'].'/'.$fileNameNew;
				if (empty($imageTitle)) {
					header('Location: AllWeHave.php?noTitle');
					die();
				} else {
					include "dbUpload.php";
					$sql = "SELECT * FROM `images`;";
					$stmt = mysqli_stmt_init($dbConnection);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
						echo "SQL connection Didn't work 1";
					} else {
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						$rowCount = mysqli_num_rows($result);
						$setImageOrder = $rowCount + 1;

						$sql = "INSERT INTO images (user,titleImage,descImage,imgFullName,orderImage) VALUES (?,?,?,?,?);";

						if (!mysqli_stmt_prepare($stmt,$sql)) {
						echo "SQL connection Didn't work 2";
						die(); 
						} else {
							mysqli_stmt_bind_param($stmt,"sssss",$_SESSION['UserLogedIn'],$imageTitle,$imageDesc,$fileNameNew,$setImageOrder);
							mysqli_stmt_execute($stmt);

							move_uploaded_file($fileTmpName, $fileDestination);
							
							header('Location: UsersProfile.php');
						}
					}
				}
			} else {
				$_SESSION['Error'] = 'File is too large';
				header('Location: AllWeHave.php?fileExceeds10MB');
				die();
			}
		} else {
			echo "There was an error uploading your image try again <br>";
			echo $fileError;
		}
	} else {
		$_SESSION['Error'] = 'File Not Allowed';
		header('Location: AllWeHave.php?fileNotAllowed');
		die();
	}
}


?>