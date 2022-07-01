<?php
session_start();

if (isset($_SESSION['UserLogedIn'])) {
	header("Location: logout.php");
	die();
} 
if (isset($_SESSION['GuestLogedIn'])) {
	echo "hello";
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
	<title>Beau Segal Login</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	<link rel="stylesheet" type="text/css" href="CSSLogin.css">
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
	<div class="container h-100 d-flex justify-content-center text-center text-white">
		<div class="row my-auto">
			<div class="col">
				<h1 class="display-1">Sign In</h1>
				<form method="post" action="loginValidation.php">	
					<?php errorDisplay(); ?>
					<div class="form-group">
					   <label class="fs-4" for="username">Username</label>
					   <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
					 </div>
					 <div class="form-group">
					   <label class="fs-4" for="password">Password</label>
					   <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
					 </div>
					 <button type="submit" class="btn btn-primary mt-2 mx-auto d-block">Submit</button>
					 <a class='btn btn-secondary btn-sm mt-2' href='register.php'>Don't have an account?</a>
					 <a class='btn btn-info btn-sm mt-2' href='guestValidation.php?guest=true' name="guest">Browse as a guest.</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>