<?php

include "checkUserLoged.php";

//key that shows who is entering
//Viewing as guest VAG
//if your link name and username are the same you get your own profile if not then guest page

if(isset($_GET['a']) && $_SESSION['UserLogedIn'] != $_GET['a']){
    $_SESSION['VAG']=$_GET['a'];
    include 'validateVAG.php';
    require_once "GuestPage.php";
    include 'profilePicGuest.php'; 
 } else{
  include "guestValidation.php";
  redirectGuest();
 	require_once "UsersPage.php";
  include 'profilePic.php'; 
 }

//I don't want multiple houses I want one house and if that person has the key they can have their house then created
//A guest key will also allow people in but with restricted acsses
//The house is always temporary

//When someone enters this page a key is given they are either a OWNER of the page or GUEST so we know what data to load

include 'searchBar.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Your Profile</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=1024">
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' stackpath.bootstrapcdn.com code.jquery.com cdn.jsdelivr.net 'unsafe-inline'">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="setImg.css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="ajaxUserLookUp.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
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
        <li class="nav-item">
          <a class="nav-link" href="AllWeHave.php">All We Have</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ourbrothers.php">Our Brothers</a>
        </li>
        <li class="nav-item <?php activePage()?>">
          <a class="nav-link" href="UsersProfile.php">Profile<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>



<?php 
searchBar(); 
if (isset($editProfilModal)) {
  echo $editProfilModal;
}
?>


<div id="profileForm">
<?php 
displayProfInfo();

?>

</div>  
<main>  

<?php imagePost(); ?>
</main>  






<script type="text/javascript">
  const observer = lozad(); // lazy loads elements with default selector as '.lozad'
  observer.observe();
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>