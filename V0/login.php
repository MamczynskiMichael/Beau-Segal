<?php
session_start();
if (isset($_SESSION['UserLogedIn'])) {
	header("Location: index.php");
	die();
} 

function valiError($choice){
	if ($choice == 'errorlen') {
		if ($_SESSION["ValiERROR"]['errorlen'] == true) {
			echo "<p class='text-danger bg-warning text-center border border-danger'>Username and/or password must be filled</p>";
		}
	}
	
	if ($choice == 'useNFo') {
		if ($_SESSION["ValiERROR"]['useNFo'] == true) {
			echo "<p class='text-danger bg-warning text-center border border-danger'>Username or password is incorrect</p>";
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

	<style type="text/css">
		

	</style>

</head>
<body>

<video autoplay loop class="embed-responsive embed-responsive-1by1" id="centFVid">
  <source class="embed-responsive-item" src="backgrounds/Shrekophone.mp4" type="video/mp4">
</video>

<form id="login" method="post" action="loginValidation.php" class="mx-auto" style="width: 200px;">
	<p class="display-4">Sign In</p>
	<?php valiError('errorlen'); valiError('useNFo');?>	
	<p class="font-weight-bold">UserName</p>
	<input type="text" id="username" name="username" class="col">
	<br>
	<br>
	<p class="font-weight-bold">Password</p>
	<input type="password" id="password" name="password" class="col">
	<br>
	<br>
	<button type="submit" class="btn btn-primary">Submit</button>
	<a class='btn btn-secondary btn-sm' href='register.php'>Register here</a>
</form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>