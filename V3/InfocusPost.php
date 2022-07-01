<?php
require "checkUserLoged.php";
include 'searchBar.php';
$_SESSION['VAG']=$_GET['a'];
include 'validateVAG.php';
//	PID = the id of the image or PostID		//
include "displayUsersProfilePic.php";
function focusedPost(){
	
	if (isset($_SESSION['PID'])) {
		unset($_SESSION['PID']);
	}
	$focusedImg = $_GET['p'];
	$_SESSION['PID']=$focusedImg;

	function gettingData(){
		$focusedImg = $_GET['p'];
		include "dbUpload.php";

		$sql = "SELECT `user`,`titleImage`, `descImage` FROM `images` WHERE imgFullName='$focusedImg'";
		$stmt = mysqli_stmt_init($dbConnection);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "sql statement failed";
		} else {
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
			echo '<h3 class="d-inline">'.$row["titleImage"].'</h3>';
			if (!empty($row["descImage"])) {
				echo '<p>'.$row["descImage"].'</p>';
			}
		}
	}
	function votingButtons(){
		//Check if you have voted before then gives appropriate button. Need voting.php for checkUserVote()
		include 'voting.php';
		function voteCount(){
			//Returns voteDisplay[up/down]
			$voteInfo = checkUserVoted();
			include "dbUpload.php";
			$sql = "SELECT `vote` FROM `votes` WHERE idImage='".$voteInfo['idImage']."'";
			$stmt = mysqli_stmt_init($dbConnection);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				echo "sql statement failed";
			} else {
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$upvoteCount = 0;
				$downvoteCount = 0;
				while ($row = mysqli_fetch_assoc($result)) {
					if ($row['vote'] === 1) {
						$upvoteCount ++;
					}
					if ($row['vote'] === 0) {
						$downvoteCount ++;
					}
				}
				$voteDisplay['up'] = "<p class='float-end upvoteCount'>".$upvoteCount."</p>";
				$voteDisplay['down'] = "<p class='float-end upvoteCount'>".$downvoteCount."</p>";
				return $voteDisplay;
			}
		}

		//voteDisplay[up/down]	
		//voteInfo[vote/userID/idImage]
		$voteDisplay = voteCount();
		$voteInfo = checkUserVoted();
		if ($voteInfo['vote'] === 1) {
			echo "
			<form action='voting.php' method='post' id='voteButtons'>
				<input class='w-25 p-4' id='downvoteButton' type='submit' value='' name='downvote'>
				".$voteDisplay['down']."
				<input class='w-25 p-4' id='upvoteSel' type='submit'  value='' name='upvote'>
				".$voteDisplay['up']."
			</form>";
		} else if ($voteInfo['vote'] === 0) {
			echo "
			<form action='voting.php' method='post' id='voteButtons'>
				<input class='w-25 p-4' id='downvoteSel' type='submit' value='' name='downvote'>
				".$voteDisplay['down']."
				<input class='w-25 p-4' id='upvoteButton' type='submit' value='' name='upvote'>
				".$voteDisplay['up']."
			</form>";
			} else {
				echo "
				<form action='voting.php' method='post' id='voteButtons'>
					<input class='w-25 p-4' type='submit' id='downvoteButton' value='' name='downvote'>
					".$voteDisplay['down']."
					<input class='w-25 p-4' type='submit' id='upvoteButton' value='' name='upvote'>
					".$voteDisplay['up']."
				</form>";
			}
	} 


	if(isset($_GET['a']) && $_SESSION['UserLogedIn'] != $_GET['a']){
		echo "<div class='FocusedPost mt-5'>";
		displayProfilePic($_SESSION['VAG']);
		echo '<img class="postImg" src="Users/'.$_SESSION['VAG'].'/'.$focusedImg.'">';
		votingButtons();
		gettingData();
		echo "</div>";

	}
	else {
		echo "<div class='FocusedPost row mt-5'>";
		displayProfilePic($_SESSION['UserLogedIn']);
		
		echo "<button form='deletePost' class='btn btn-secondary float-end w-25 me-2' type='submit' name='deletePost'>Delete Post</button>";
		echo '<img class="w-75 py-2 lozad rounded-3 d-block" src="Users/'.$_SESSION['UserLogedIn'].'/'.$focusedImg.'">';
		votingButtons();
		gettingData();
		echo "</div>";
		echo '<form id="deletePost" action="deletePost.php" method="post" class"d-none"></form>';

		
	}
}
function comments(){

	include "dbUpload.php";
	$sql = "SELECT `idImage` FROM `images` WHERE `imgFullName`='".$_SESSION['PID']."';";
	$stmt = mysqli_stmt_init($dbConnection);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
	echo "SQL connection didn't work comments 1";
	die(); 
	} else {
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$idImage = $row['idImage'];


		//Show the Owner of the Post Comments First
		$sql = "SELECT `user`,`comment`,`timeStamp` FROM `comments` WHERE `idImage`= ".$idImage." AND `user`= '".$_SESSION['VAG']."'";
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "SQL connection didn't work comments 1.5";
		die(); 
		} else {
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($postUser = mysqli_fetch_assoc($result)) {
      			$postersUsername[] = $postUser['user'];
      			$postersComment[] = $postUser['comment'];
      			$posterTimeStamp[] = $postUser['timeStamp'];
    		}
    		if (!empty($postersUsername)) {
    			for ($i=0; $i < sizeof($postersUsername); $i++) { 
    				if ($postersUsername[$i] == $_SESSION['UserLogedIn']) {
    					echo "
		     			<div id='comments' class='mb-3 row d-flex justify-content-center'> 
		     			";

		     			displayProfilePic($postersUsername[$i]);
		     			echo "
		     			<p class='fs-4'>".$postersComment[$i]."</p>
		     			
		     			
		     			<button form='deleteComment".$i."' class='btn btn-secondary float-end mt-4' type='submit' name='deleteComment'>Delete Comment</button>
		     			
		     			<form id='deleteComment".$i."' action='deletePost.php' method='post' class'd-none'>
		     			<input type='hidden' name='comment' value='".$postersComment[$i]."_".$posterTimeStamp[$i]."' >
		     			</form>
		     			</div>
		     			";
    				} else {
    					echo "
		     			<div id='comments' class='mb-3 row d-flex justify-content-center'";
		     			displayProfilePic($postersUsername[$i]);
		     			echo "
		     			<p class='fs-4'>".$postersComment[$i]."</p>
		     			</div>
		     			";
    				}
    			}
    		}
		}



		//Adds All comments other than owner of the Post
		$sql = "SELECT `user`,`comment`,`timeStamp` FROM `comments` WHERE `idImage`= ".$idImage." AND NOT `user`= '".$_SESSION['VAG']."'";
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		echo "SQL connection didn't work comments 2";
		die(); 
		} else {
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
      			$users[] = $row['user'];
      			$comment[] = $row['comment'];
      			$timeStamp[] = $row['timeStamp'];
    		}
    		if (!empty($users)) {
				for ($i=0; $i < sizeof($users); $i++) { 
					if ($users[$i] == $_SESSION['UserLogedIn']) {
		     			echo "
		     			<div id='comments' class='mb-3 row d-flex justify-content-center text-break'>";
		     			displayProfilePic($users[$i]);
		     			echo "
		     			<p class='fs-4'>".$comment[$i]."</p>
		     			<button form='deleteComment".$i."' class='btn btn-secondary float-end mt-4' type='submit' name='deleteComment'>Delete Comment</button>
		     			
		     			<form id='deleteComment".$i."' action='deletePost.php' method='post' class'd-none'>
		     			<input type='hidden' name='comment' value='".$comment[$i]."_".$timeStamp[$i]."' >
		     			</form>
		     			</div>
		     			";
					} else {
		     			echo "
		     			<div id='comments' class='mb-3 row d-flex justify-content-center text-break'>";
		     			displayProfilePic($users[$i]);
		     			echo "
		     			<p class='fs-4'>".$comment[$i]."</p>
		     			</div>
		     			";	
	    			}
	    		}
    		}
		}
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Our Brothers</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	<link rel="stylesheet" type="text/css" href="mainStyling.css">
	<link href="https://fonts.googleapis.com/css?family=Marck+Script&display=swap" rel="stylesheet">
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
	        <li class="nav-item ">
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

	<main class="container-lg text-center lead mt-3 pt-5">

	<?php focusedPost();?>

	<form action="commentOnPost.php" method="POST" enctype="multipart/form-data" id="commentsForm">
		
		<div class="form-group">
			<input type="text" class="form-control text-center" id="profileEdit" placeholder="Add your own comment" name="commentOnPost">
		</div>
	</form>


	<?php comments();?>

	</main>
  	<script type="text/javascript">
    	const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    	observer.observe();
  	</script>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>