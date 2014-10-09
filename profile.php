<?php

include "includes/functions.php";

$currentUser=new User($_GET['id']);

if($currentUser->membership == 0){
	$_SESSION['error'] = "This user's profile has not gone public yet.";
	header("location: index.php");
}

include "includes/userinfo.php";

?>