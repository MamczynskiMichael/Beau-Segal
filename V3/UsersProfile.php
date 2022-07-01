<?php

include "checkUserLoged.php";
include 'searchBar.php';
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



?>

<!DOCTYPE html>
<html>
<head>
	<title>Your Profile</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' stackpath.bootstrapcdn.com code.jquery.com cdn.jsdelivr.net 'unsafe-inline'">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="mainStyling.css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="ajaxUserLookUp.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
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
        <li class="nav-item">
          <a class="nav-link" href="AllWeHave.php">All We Have</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ourbrothers.php">Our Brothers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php activePage()?>" href="UsersProfile.php">Profile</a>
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



<?php 
if (isset($editProfilModal)) {
  echo $editProfilModal;
}
?>


<div id="profileForm" class="container d-block bg-light w-50 mt-5 pt-3 text-center">
<?php 
displayProfInfo();

?>

</div>  
<main class="container-lg text-center lead mt-5 pt-3">  

<?php imagePost(); ?>
</main>  






<script type="text/javascript">
  const observer = lozad(); // lazy loads elements with default selector as '.lozad'
  observer.observe();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>