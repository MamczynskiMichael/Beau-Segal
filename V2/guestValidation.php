<?php
session_start();
if (!empty($_GET['guest'])) {
	$_SESSION['GuestLogedIn'] = true;
	$_SESSION['UserLogedIn'] = "Guest User";

	header("Location: innercult.php?guestAccess");
	exit();
}

//When guest attempts to enter certain areas they are prompted to make an account.
function redirectGuest (){
	if (isset($_SESSION['GuestLogedIn']) && $_SESSION['GuestLogedIn'] == true){
	$_SESSION['Error'] = 'You must create an account to use this feature';
	header("Location: register.php?CreateAnAccount");
	exit();
	}
}
//include "guestValidation.php";
//redirectGuest();


?>