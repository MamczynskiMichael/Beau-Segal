<?php  
session_start();
if (!isset($_SESSION['UserLogedIn'])) {
	http_response_code(403);
	die;
}
function Userlist()
{
	$serverName = "localhost";
	$dbAdminName = "root";
	$dbAdminPassword = "root";
	$dbName = "theboysjourneys";
	$dbConnection = new mysqli($serverName, $dbAdminName, $dbAdminPassword, $dbName);
	if ($dbConnection->connect_error) {
		die("Connection failed: " . $dbConnection->connect_error);}
	$sql = "SELECT username FROM `users`";
	$result = $dbConnection->query($sql);	
	while($row = $result->fetch_array())
	{
	$rows[] = $row;
	}
	foreach($rows as $row)
	{
	echo $row['username'] . "<br>";
	}
	$result->close();
	$mysqli->close();
}
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Our Brothers</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="setImg.css">
	<link href="https://fonts.googleapis.com/css?family=Marck+Script&display=swap" rel="stylesheet">
	<style type="text/css">
		body {
			overflow-y:hidden;
			}
		#main {
			color: white;
			font-family: 'Marck Script', cursive;
		}
	</style>
</head>
<body>

<video autoplay loop class="embed-responsive embed-responsive-1by1">
  <source class="embed-responsive-item" src="backgrounds/SCREAM.mp4" type="video/mp4">
</video>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="z-index: 1;">
  <div class="container">
    <a class="navbar-brand" href="#">Every day we become stronger <?php echo $_SESSION['UserLogedIn'];?></a>
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
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<br>

<section id="main" class="py-5 fixed-top" style="z-index: 0;">
  <div class="container text-center">
    <h1 class="display-2">The cult becomes larger</h1>
    <p class="lead"><?php Userlist(); ?></p>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>