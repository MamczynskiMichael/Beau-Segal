<?php

//2 hours
$inactive = 86400;
ini_set('session.gc_maxlifetime', $inactive);

session_start();

//Sends you to login if you've been inactive to long

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $inactive)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    header("Location: login.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp




//Removes you if you are not logged in before you've enterd the page

if (!isset($_SESSION['UserLogedIn'])) {
	header("Location: login.php?NotLogedIn");
	die();
}
if (!isset($_SESSION['GuestLogedIn']) && !isset($_SESSION['UserLogedIn'])) {
    header("Location: login.php?NotLogedIn");
    die();
}

?>

