<?php

//This code gets all the posts on the screen and handles the order of them.
if (isset($_POST['order'])) {
  header("Location: AllWeHave.php?order=".$_POST['order']."");
  die();
}
function orderButtonFocusUp(){
  if ($_GET['order'] == 'Upvotes' || !isset($_GET['order'])) {
    echo "active";
  }
}
function orderButtonFocusNew(){
  if ($_GET['order'] == 'Newest') { 
    echo "active";
  }
}
if (!isset($_GET['order']) || $_GET['order'] == 'Upvotes') {
  function displayPosts(){
    include_once "dbUpload.php";
    $sql = "SELECT * FROM `images`";
    $stmt = mysqli_stmt_init($dbConnection);
    if (!mysqli_stmt_prepare($stmt,$sql)){
      Echo "Database Connection Failed";
      die();
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $allImageInformation = array();
      while ($row = mysqli_fetch_assoc($result)) {
        $lastImageInformation = 
          array(
            'idImage' => $row['idImage'],
            'user' => $row['user'],
            'titleImage' => $row['titleImage'],
            'descImage' => $row['descImage'],
            'imgFullName' => $row['imgFullName'],
            'voteCount' => 0);
        array_push($allImageInformation, $lastImageInformation);
      }
      //Calculate voteCount for every image
      for ($i=0; $i < sizeof($allImageInformation); $i++) {
        $currentImgID = $allImageInformation[$i]['idImage']; 
        $sql = "SELECT `idImage` FROM `votes` WHERE `idImage`= '".$currentImgID."' AND NOT vote = '0' ";
        if (!mysqli_stmt_prepare($stmt,$sql)){
          Echo "Database Connection Failed";
          die();
        } else {
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          $rowCount = mysqli_num_rows($result);
          if ($rowCount != 0) {
            $voteCount = $rowCount;
            $allImageInformation[$i]['voteCount'] = $voteCount;
          } 
        }
      }
      //fuction to sort voteCount
      function val_sort($array,$key) {
        //Grab all the values from the key and make an array
        foreach($array as $k=>$v) {
          $b[] = $v[$key];
        }   
        //sort it low to high
        arsort($b);

        //put all the values back with other key
        foreach ($b as $k=>$v) {
          $c[] = $array[$k];
        } 
          return $c;
      }
      include 'displayUsersProfilePic.php';
      $allImageInformation = val_sort($allImageInformation,'voteCount');
      for ($i=0; $i < sizeof($allImageInformation); $i++) { 
        echo '    
          <div id="frontPagePost">';
            displayProfilePic($allImageInformation[$i]['user']); 
        echo '
            <a href="InfocusPost.php?a='.$allImageInformation[$i]['user'].'&p='.$allImageInformation[$i]['imgFullName'].'" class="text-decoration-none"> 
              <img class="postImg lozad" data-src="Users/'.$allImageInformation[$i]['user'].'/'.$allImageInformation[$i]['imgFullName'].'";>
            </a>
          </div>';
      }
    }
  }
  } else if ($_GET['order'] == 'Newest') {
  function displayPosts(){
    $userName = $_SESSION['UserLogedIn'];
    include_once "dbUpload.php";
    $sql = "SELECT * FROM `images` ORDER BY `images`.`idImage` DESC";
    $stmt = mysqli_stmt_init($dbConnection);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      echo "sql statement failed";      
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row['user'];
        $imgName[] = $row['imgFullName'];
      }
    //Here I just add all the posts and title
      include 'displayUsersProfilePic.php';
      if (!empty($users)) {
        for ($i=0; $i < sizeof($users); $i++) { 

        echo '    
          <div id="frontPagePost">';
            displayProfilePic($users[$i]); 
        echo '
            <a href="InfocusPost.php?a='.$users[$i].'&p='.$imgName[$i].'" class="text-decoration-none"> 
            
              <img class="postImg lozad" data-src="Users/'.$users[$i].'/'.$imgName[$i].'";>
            </a>
          </div>';
        }
      }
    }
  }
}



?>