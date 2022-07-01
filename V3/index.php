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
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="CSSLogin.css">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-1HYPE4TRMN"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-1HYPE4TRMN');
	</script>
</head>

<body id="bgIndex">
	<div class="container h-100 d-flex justify-content-center text-center"> 
		<div class="row my-auto">
			<div class="col">
				<h1 class="display-1">Welcome</h1>
				<a href='login.php' role='button' class='btn btn-dark'>See what we have to offer!</a>
			</div>
		</div>
	</div>	


</body>
</html>