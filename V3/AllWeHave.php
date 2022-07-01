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
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	
  <link rel="stylesheet" type="text/css" href="mainStyling.css">
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
<body  class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="border-bottom: 1px solid #F2F2F2;">
    <div class="container">
      <a class="navbar-brand text-break" href="UsersProfile.php">Welcome <?php echo $_SESSION['UserLogedIn'];?></a>
      <button class="navbar-toggler mx-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarResponsive">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="innercult.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="AllWeHave.php">All We Have</a>
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
  <main class="container-lg text-center lead mt-5 pt-3">
      <div class="row justify-content-md-center mt-5">
        <div class="col-sm">
          <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#submitPostModal">Share a photo of any discovery!</button>
        </div>
        <div class="modal fade" id="submitPostModal" tabindex="-1" role="dialog" aria-labelledby="submitPostModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="submitPostModalLabel">Add an image to the cult</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="fileUpload.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <?php errorDisplay();?>
                    <div class="form-group"> 
                      <div class="custom-file ">  
                      <div class="input-group">                     
                        <input type="file" class="form-control" id="inputGroup" name="userPostImg">
                        <label class="input-group-text" for="inputGroup" >Select an image*</label>
                      </div>

                        <input type="text" class="form-control text-center mt-2" id="postTitle" placeholder="Title*" name="filetitle">
                        <input type="text" class="form-control text-center mt-2" id="postDesc" placeholder="Description" name="filedesc">
                     </div> 
                    </div>
                   
                </div>         
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Order
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <form action="AllWeHaveProcessing.php" method="POST" enctype="multipart/form-data">
                <button class="dropdown-item <?php orderButtonFocusUp();?>" type='submit' name='order' value="Upvotes">Popular</button>
                <button class="dropdown-item <?php orderButtonFocusNew();?>" type='submit' name='order' value="Newest">Newest</button>
              </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>