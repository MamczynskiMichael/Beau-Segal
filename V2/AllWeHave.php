<?php
require "checkUserLoged.php";
require 'classErrorHandler.php';
include 'AllWeHaveProcessing.php';
include 'searchBar.php';

function errorDisplay(){
  if (isset($_SESSION['Error'])) {

  $errorHandler = new ClassErrorHandler($_SESSION['Error']);
  echo $errorHandler->get_Error();
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Beau Segal Findings</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=1024">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">	
  <link rel="stylesheet" type="text/css" href="setImg.css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="ajaxUserLookUp.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
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
      <a class="navbar-brand text-break" href="UsersProfile.php">Welcome <?php echo $_SESSION['UserLogedIn'];?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="innercult.php">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="AllWeHave.php">All We Have<span class="sr-only">(current)</span></a>
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
  <?php 
  searchBar(); 
  ?>
  <main>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-sm">
          <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#submitPostModal">Share a photo of any discovery!</button>
        </div>
        <div class="modal fade" id="submitPostModal" tabindex="-1" role="dialog" aria-labelledby="submitPostModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="submitPostModalLabel">Add an image to the cult</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="fileUpload.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <?php errorDisplay();?>
                    <div class="form-group"> 
                      <div class="custom-file">                       
                        <input type="file" class="custom-file-input" id="inputGroup" name="userPostImg">

                        <label class="custom-file-label text-center" for="inputGroup" aria-describedby="inputGroup">Select an image*</label>
                        <input type="text" class="form-control text-center mt-2" id="postTitle" placeholder="Title*" name="filetitle">
                        <input type="text" class="form-control text-center mt-2" id="postDesc" placeholder="Optional Description" name="filedesc">
                     </div> 
                    </div>
                   
                </div>         
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" type="submit" name="submit">Send</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm">
          <h1 class="display-4 text-center">All We Have</h1>
        </div>
        <div class="col-sm">
          <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Order
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <form action="AllWeHaveProcessing.php" method="POST" enctype="multipart/form-data">
              <button class="dropdown-item <?php orderButtonFocusUp();?>" type='submit' name='order' value="Upvotes">Popular</button>
              <button class="dropdown-item <?php orderButtonFocusNew();?>" type='submit' name='order' value="Newest">Newest Sighting</button>
            </form>
          </div>
        </div>
        </div>
      </div>
    </div>

    <?php
    displayPosts();
    ?>
  </main>

  <script type="text/javascript">
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
  </script>

  


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>