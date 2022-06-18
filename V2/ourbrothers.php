<?php  
require "checkUserLoged.php";
function Userlist() {
	include "dbUpload.php";
	$sql = "SELECT username FROM `users` ORDER BY `users`.`username` ASC";
	$stmt = mysqli_stmt_init($dbConnection);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "SQL connection Didn't work 1";
	} else {
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		$dbConnection->close();
		while ($row = mysqli_fetch_assoc($result)) {
			$users[] = $row['username'];

		}
		for ($i=0; $i < sizeof($users); $i++) { 
			echo '<a href="UsersProfile.php?a='.$users[$i].'">'.$users[$i].'</a><br>';
		}
	}
}
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Beau Segal Brothers</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=1024">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">	
  <link rel="stylesheet" type="text/css" href="setImg.css">
	<link href="https://fonts.googleapis.com/css?family=Marck+Script&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="ajaxUserLookUp.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-1HYPE4TRMN"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-1HYPE4TRMN');
	</script>
</head>
<body id="allButMain" class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="border-bottom: 1px solid #F2F2F2;">
  <div class="container">
    <a class="navbar-brand" href="UsersProfile.php">Welcome <?php echo $_SESSION['UserLogedIn'];?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="innercult.php">Home</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="AllWeHave.php">All We Have</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="ourbrothers.php">Our Brothers<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="UsersProfile.php">Profile</a>
        </li>        
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<?php 
include 'searchBar.php';
searchBar(); 
?>
<main>


  <div class="container text-center lead">
    <div class="row flex-nowrap">
    	<div class="col-md-12 col-md-offset-3">
    		<h1 class="display-4">A list of all of our members.<br> See what they have to share!</h1>
		</div>
	</div>
	<div class="row flex-nowrap">
		<div class="col-md-12 col-md-offset-3">
    		<?php Userlist(); ?>
    	</div>
  	</div>
  </div>
</main>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>