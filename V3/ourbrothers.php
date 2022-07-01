<?php  
require "checkUserLoged.php";
include 'searchBar.php';
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
			echo '
			<div class="row flex-nowrap">
				<div class="col-md-12 col-md-offset-3">
				<a href="UsersProfile.php?a='.$users[$i].'">'.$users[$i].'</a>
				</div>
			</div>';
		}
	}
}
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Beau Segal Brothers</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	
  <link rel="stylesheet" type="text/css" href="mainStyling.css">
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
<body  class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="border-bottom: 1px solid #F2F2F2;">
  <div class="container">
    <a class="navbar-brand" href="UsersProfile.php">Welcome <?php echo $_SESSION['UserLogedIn'];?></a>
    <button class="navbar-toggler mx-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarResponsive">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="innercult.php">Home</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="AllWeHave.php">All We Have</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="ourbrothers.php">Our Brothers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="UsersProfile.php">Profile</a>
        </li>        
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>
        <?php 
        	searchBar(); 
        ?>
      </ul>
    </div>
  </div>
</nav>



<main class="container-lg text-center lead mt-5 pt-3">

	<div class="row flex-nowrap">
		<div class="col-md-12 col-md-offset-3">
			<h1 class="display-6">A list of all of our members.<br> See what they have to share!</h1>
		</div>
	</div>
	<?php Userlist(); ?>

</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>