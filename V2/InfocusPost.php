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
				$voteDisplay['up'] = "<p class='float-right upvoteCount'>".$upvoteCount."</p>";
				$voteDisplay['down'] = "<p class='float-right upvoteCount'>".$downvoteCount."</p>";
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
				<input id='downvoteButton' type='submit' value='' name='downvote'>
				".$voteDisplay['down']."
				<input id='upvoteSel' type='submit'  value='' name='upvote'>
				".$voteDisplay['up']."
			</form>";
		} else if ($voteInfo['vote'] === 0) {
			echo "
			<form action='voting.php' method='post' id='voteButtons'>
				<input id='downvoteSel' type='submit' value='' name='downvote'>
				".$voteDisplay['down']."
				<input id='upvoteButton' type='submit' value='' name='upvote'>
				".$voteDisplay['up']."
			</form>";
			} else {
				echo "
				<form action='voting.php' method='post' id='voteButtons'>
					<input type='submit' id='downvoteButton' value='' name='downvote'>
					".$voteDisplay['down']."
					<input type='submit' id='upvoteButton' value='' name='upvote'>
					".$voteDisplay['up']."
				</form>";
			}
	} 


	if(isset($_GET['a']) && $_SESSION['UserLogedIn'] != $_GET['a']){
		echo "<div class='FocusedPost'>";
		displayProfilePic($_SESSION['VAG']);
		echo '<img class="postImg" src="Users/'.$_SESSION['VAG'].'/'.$focusedImg.'">';
		votingButtons();
		gettingData();
		echo "</div>";

	}
	else {
		echo "<div class='FocusedPost'>";
		displayProfilePic($_SESSION['UserLogedIn']);
		
		echo "<button form='deletePost' class='btn btn-secondary float-right' type='submit' name='deletePost'>Delete Post</button>";
		echo '<img class="postImg" src="Users/'.$_SESSION['UserLogedIn'].'/'.$focusedImg.'">';
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
		     			<div id='comments' class='mb-2'>";
		     			displayProfilePic($postersUsername[$i]);
		     			echo "
		     			<button form='deleteComment".$i."' class='btn btn-secondary float-right mt-4' type='submit' name='deleteComment'>Delete Comment</button>
		     			<p id='commentText'>".$postersComment[$i]."</p>
		     			<form id='deleteComment".$i."' action='deletePost.php' method='post' class'd-none'>
		     			<input type='hidden' name='comment' value='".$postersComment[$i]."_".$posterTimeStamp[$i]."' >
		     			</form>
		     			</div>
		     			";
    				} else {
    					echo "
		     			<div id='comments'>";
		     			displayProfilePic($postersUsername[$i]);
		     			echo "
		     			<p id='commentText'>".$postersComment[$i]."</p>
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
		     			<div id='comments' class='mb-3'>";
		     			displayProfilePic($users[$i]);
		     			echo "
		     			<button form='deleteComment".$i."' class='btn btn-secondary float-right mt-4' type='submit' name='deleteComment'>Delete Comment</button>
		     			<p id='commentText'>".$comment[$i]."</p>
		     			<form id='deleteComment".$i."' action='deletePost.php' method='post' class'd-none'>
		     			<input type='hidden' name='comment' value='".$comment[$i]."_".$timeStamp[$i]."' >
		     			</form>
		     			</div>
		     			";
					} else {
		     			echo "
		     			<div id='comments'>";
		     			displayProfilePic($users[$i]);
		     			echo "
		     			<p id='commentText'>".$comment[$i]."</p>
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
    <meta name="viewport" content="width=1024">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">	<link rel="stylesheet" type="text/css" href="setImg.css">
	<link href="https://fonts.googleapis.com/css?family=Marck+Script&display=swap" rel="stylesheet">
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
	      </ul>
	    </div>
	  </div>
	</nav>
	<?php searchBar(); ?>

	<main>

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
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>