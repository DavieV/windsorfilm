<?php 
include "includes/functions.php";

$currentUser=currentUser();

if(!isset($currentUser->id)){		/* Redirect if the user is not signed in */
	$_SESSION['error'] = "Sorry! You have to be logged in to access this page";
	header("location: index.php");
	die();
}
if(!$currentUser->isConfirmed()){		/* Redirect if the user has not confirmed their email address */
	header("location: reconfirm.php");
	die();
}
if($currentUser->membership == 0){
	$_SESSION['error'] = "We're Sorry! You have to sign up for a membership in order to acccess the page.";
	header("location: index.php");
	die();
}

include "includes/userinfo.php";
?>