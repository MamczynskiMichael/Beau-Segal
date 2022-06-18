<?php
session_start();
if (!isset($_SESSION['UserLogedIn'])) {
	http_response_code(403);
	die;
}

#Lets Learn OOP or not


class imgUserPost{
	private $user;
	private $img;
	private $tags;
	private $popularity;

	public function receiveImg($url){
		$this->img = $url;
	}
	public function grabImg(){
		return $this->img;
	}

}

#gotta learn file systems










?>
<!DOCTYPE html>
<html>
<head>
	<title>Pain</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="setImg.css">

</head>
<body>

<audio autoplay>
  <source src="backgrounds\music\Sanctuary.wav" type="audio/wav">
Your browser does not support the audio element.
</audio>
<!--
//WORKING ON OTHER STUFF//
-->
<br><br><br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Lets see if you can send an img and I can return it</h1>
        <p>Add your image</p>
        <input type="file" name="userPostImg"><br>
        <p>Im gonna make a tag feture some time but thinking about it and its gonna be hard you know making validation and such</p>
        <input type="text" name="tags" value="Don't Fill"><br>
        <input type="submit">
    </form>


<br><br><br><br>
<h1>Where I will return the image</h1>


<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
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
        <li class="nav-item active">
          <a class="nav-link" href="AllWeHave.php">All We Have<span class="sr-only">(current)</span></a>
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



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>