<?php 
session_start();

if (isset($_SESSION['UserLogedIn'])) {
	header("Location: index.php");
	die();
}

function valiError($choice){

	if ($choice == 'pasNsame') {
		if ($_SESSION["ValiERROR"]['pasNSame'] == true) {
			echo "<p class='text-danger bg-warning text-center border border-danger' class='p-3 mb-2 bg-warning text-dark'>Passwords are not the same</p>";
		}
	}
	if ($choice == 'errorlen') {
		if ($_SESSION["ValiERROR"]['errorlen'] == true) {
			echo "<p class='text-danger bg-warning text-center border border-danger'>Username and/or password must be filled</p>";
		}
	}
	if ($choice == 'errorlenpas') {
		if ($_SESSION["ValiERROR"]['errorlenpas'] == true) {
			echo "<p class='text-danger bg-warning text-center border border-danger'>Password must be 7 or more characters</p>";
		}
	}
	if ($choice == 'noCap') {
		if ($_SESSION["ValiERROR"]['noCap'] == true) {
			echo "<p class='text-danger bg-warning text-center border border-danger'>Username and/or password must have at least one capital</p>";
		}
	}
	if ($choice == 'namTake') {
		if ($_SESSION["ValiERROR"]['namTake'] == true) {
			echo "<p class='text-danger bg-warning text-center border border-danger'>Username is taken</p>";
		}
	}
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>My Chat</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="setImg.css">


</head>
<body>
	
<video autoplay loop class="embed-responsive embed-responsive-1by1" id="centFVid">
  <source class="embed-responsive-item" src="backgrounds/Shrekophone.mp4" type="video/mp4">
</video>

<form id="login" method="post" action="createAccount.php" class="mx-auto" style="width: 200px;">
	<p class="display-4">Join</p>
	<?php valiError('errorlen'); valiError('noCap'); valiError('errorlenpas'); valiError('pasNsame'); valiError('namTake'); ?>	
	<p class="font-weight-bold">UserName</p>
	<input type="text" name="username" class="col">	
	<p class="font-weight-bold">Password</p>
	<input type="password" name="password" class="col">
	<p class="font-weight-bold">Retype Password</p>
	<input type="password" name="passwordVal" class="col">
	<button type="submit" class="btn btn-primary">Submit</button>
	<a class="btn btn-secondary btn-sm"  class="w-25 p-3" href="login.php">Have an account?</a>
</form>






<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>