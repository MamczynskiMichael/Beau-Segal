<?php 
session_start();
//prevents double logging but lets guest stay sign in
if (isset($_SESSION['UserLogedIn']) && !isset($_SESSION['GuestLogedIn'])) {
	header("Location: logout.php");
	die();
}


require 'classErrorHandler.php';
function errorDisplay(){
  if (isset($_SESSION['Error'])) {

  $errorHandler = new ClassErrorHandler($_SESSION['Error']);
  echo $errorHandler->get_Error();
  }
}


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Beau Segal Register</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=1024">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">	<link rel="stylesheet" type="text/css" href="CSSLogin.css">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-1HYPE4TRMN"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-1HYPE4TRMN');
	</script>
</head>
<body id="bgLogReg">
	


<form id="login" class="buttbottcent" method="post" action="createAccount.php" class="mx-auto text-center" style="width: 200px;">
	<p class="display-4">Join</p>
	<?php errorDisplay(); ?>	
	<p class="font-weight-bold">Username</p>
	<input type="text" name="username" class="col">	
	<br>
	<br>
	<p class="font-weight-bold">Password</p>
	<input type="password" name="password" class="col">
	<br>
	<br>
	<p class="font-weight-bold">Retype Password</p>
	<input type="password" name="passwordVal" class="col">
	<br>
	<br>
	<button type="submit" class="btn btn-primary mb-1">Submit</button>
	<a class="btn btn-secondary btn-sm" href="login.php">Already have an account?</a>
</form>






<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>