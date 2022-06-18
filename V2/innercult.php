<?php

require "checkUserLoged.php";
if ($_SESSION['UserLogedIn'] == 'admin') {
  echo "<a style='position:absolute;z-index:20000;' href='admin.php'>Admin Panel</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Beau Segal Prayer</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=1024">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">	<link rel="stylesheet" type="text/css" href="setImg.css">
 <!-- Global site tag (gtag.js) - Google Analytics -->
 <script async src="https://www.googletagmanager.com/gtag/js?id=G-1HYPE4TRMN"></script>
 <script>
   window.dataLayer = window.dataLayer || [];
   function gtag(){dataLayer.push(arguments);}
   gtag('js', new Date());

   gtag('config', 'G-1HYPE4TRMN');
 </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="UsersProfile.php">Welcome <?php echo $_SESSION['UserLogedIn'];?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="innercult.php">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="AllWeHave.php">All We Have</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ourbrothers.php">Our Brothers</a>
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

<header>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active" style="background-image: url('mainArt/newDiscovery.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4 bg-dark rounded">Brick Cap Spore Print</h2>
          <p class="lead bg-dark rounded">Remeber to get out and find something new!</p>
        </div>
      </div>
      <div class="carousel-item" style="background-image: url('mainArt/adventure.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4">Adventure</h2>
          <p class="lead">It's essential to a healthy life</p>
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
  <div class="text-center container">
    <h1 class="display-4">Welcome to the Beau Segal website</h1>
    <p class="fs-1">This website is dedicated to Beau Segal. He is a figure that has been shown in two short films that describe how he follows his dreams of adventuring even though his life is mysterious. Here we share sightings of our passions as Beaus does. You will find many pictures of mushrooms, plants, and animals throughout this site. We encourage you make an account and share your own discoveries today!</p>
    <h1 class="display-4">Who is Beau Segal? A short film.</h1>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/2jGDC48_Fsc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <p class="lead">History of Beau</p>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/l72QUu4rEHc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
</section>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>