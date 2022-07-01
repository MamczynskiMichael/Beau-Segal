<?php

require "checkUserLoged.php";
include 'searchBar.php';
if ($_SESSION['UserLogedIn'] == 'admin') {
  echo "<a style='position:absolute;z-index:20000;' href='admin.php'>Admin Panel</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Beau Segal Prayer</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	<link rel="stylesheet" type="text/css" href="mainStyling.css">
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
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="UsersProfile.php">Welcome <?php echo $_SESSION['UserLogedIn'];?></a>
    <button class="navbar-toggler mx-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarResponsive">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="innercult.php">Home</a>
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
        <?php 
          searchBar(); 
        ?>
      </ul>
    </div>
  </div>
</nav>



<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
  </div>
  <div class="carousel-inner ">
    <div class="carousel-item h-30 active">
      <img src="mainArt/newDiscovery.jpg" class="h-100 w-100 " alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Brick Cap Spore Print</h5>
        <p>Remeber to get out and find something new!</p>
      </div>
    </div>
    <div class="carousel-item h-30 ">
      <img src="mainArt/adventure.jpg" class="h-100 w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Adventure</h5>
        <p>It's essential to a healthy life</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


<div class="container justify-content-center text-center py-2">

  <div class="row">
    <div class="col">
      <h1 class="display-4">Welcome to the Beau Segal website</h1>
      <p class="lead fs-3">This website is dedicated to Beau Segal. He is a figure that has been shown in two short films that describe how he follows his dreams of adventuring even though his life is mysterious. Here we share our sightings and passions as Beau does. You will find many pictures of mushrooms, plants, and animals throughout this site. We encourage you make an account and share your own discoveries today!</p>
      <h1 class="display-4">Who is Beau Segal? A short film.</h1>
      <iframe class="min-vw-50 min-vh-50" src="https://www.youtube.com/embed/2jGDC48_Fsc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <p class="lead">History of Beau</p>
      <iframe class="min-vw-50 min-vh-50" src="https://www.youtube.com/embed/l72QUu4rEHc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>
</html>