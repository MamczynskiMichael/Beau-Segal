<?php
session_start();

function startLog(){
	if (isset($_SESSION['UserLogedIn'])) {
		header("Location: innercult.php");
		die();
	}
	else {
		$LoginButt = "<div class='buttbottcent' class='mx-auto' style='width: 40%;'> <a href='login.php' role='button' class='btn btn-dark btn-lg btn-block'>Join us wont you</a></div>";
		echo $LoginButt;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>My Chat</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="setImg.css">
</head>
<body class="bg">

<div class="mx-auto p-3 text-center" style="width: 40%;"> 
	<h1 class="display-1">Welcome Brother</h1>
	<?php startLog(); ?>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>