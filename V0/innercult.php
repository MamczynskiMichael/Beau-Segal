<?php
session_start();
if (!isset($_SESSION['UserLogedIn'])) {
	http_response_code(403);
	die;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pray my child</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="setImg.css">
	<style type="text/css">
		.carousel-item {
		  height: 100vh;
		  min-height: 350px;
		  background: no-repeat center center scroll;
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
			}
	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">Every day we become stronger <?php echo $_SESSION['UserLogedIn'];?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="innercult.php">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="AllWeHave.php">All We Have</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ourbrothers.php">Our Brothers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<header>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active" style="background-image: url('mainArt/BeauSegal.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4">The Cult of Beau Segal</h2>
          <p class="lead">Remember to pray ever other hour my friends.</p>
        </div>
      </div>
      <div class="carousel-item" style="background-image: url('mainArt/MinoritiesFucked.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4">Hey mister</h2>
          <p class="lead">Have you fucked a minority today?</p>
        </div>
      </div>
      <div class="carousel-item" style="background-image: url('mainArt/Notallowed.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4">What did I fucking say</h2>
          <p class="lead">If that polack comes back I'm getting Jet Jaguar.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>
</header>

<section class="py-5">
  <div class="container">
    <h1 class="display-4">I have no idea what I'm doing here</h1>
    <p class="lead">The original site was started over a year ago but the chad Boryski is retarted. Now that he's less retarted he can do about 2 more things than previously. All of the boys shit will be categorized and recorded here in some god forsaken way.</p>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>