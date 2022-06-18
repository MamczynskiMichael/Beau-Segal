<?php
session_start();

if (isset($_SESSION['UserLogedIn'])) {
		header("Location: innercult.php");
		die();
}

	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Beau Segal</title>
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

<body id="bgIndex" class="container text-center"> 
		<div class="row">
			<div class="column mx-auto">
				<h1 class="display-1">Welcome</h1>
			</div>
		</div>
		<div class="row">
			<div class='column mx-auto'> 
				<a href='login.php' role='button' class='btn btn-dark btn-lg btn-block'>See what we have to offer!</a>
			</div>
		</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>