<?php

/*

	TODO:
	Clean this file up


*/

//Updates the database with the user's profile information after they fill out the form
include "includes/functions.php";

$currentUser=currentUser();

$membership = $currentUser->membership;

//profile image
//have to strip punctuation from the string
$phone = htmlspecialchars($_POST['phone']);

if(isset($_POST['businessphone'])){
	$businessphone = htmlspecialchars($_POST['businessphone']);
}

if(isset($_POST['video'])){
	$video = htmlspecialchars($_POST['video']);
}

if(isset($_POST['image'])){
	$image = htmlspecialchars($_POST['image']);

	//this prevents people from adding their own attributes to images, e.x. http://test.com/image ' height=1000
	if (filter_var($image, FILTER_VALIDATE_URL) === FALSE){
		header("location: profileform.php");
		die();
	}
}

if(strlen($_POST['bio'])>0){
	$bio = htmlspecialchars($_POST['bio']);

	if(strlen($bio)>$currentUser->bioLength()){
		header("location: profileform.php");
		die();
	}
}


$submittedTalents=array();

for($i=1;$i<=$currentUser->numTalents();$i++) //build an array of the submitted talents
	$submittedTalents[]=$_POST['talent'.$i];  //will be checked against valid talents to prevent value editing

if(!validTalents($submittedTalents)){
	header("location: profileform.php");
	die();
}

$talents=implode(",", $submittedTalents); //if they pass validation, generate the string



/*


Lets try to short this to 1 query if possible

there has to be a nicer way than this


*/
if($membership == 1){
	if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, bio=?, talents=? WHERE id=?")){
		$stmt->bind_param("ssssd", $phone, $businessphone, $bio, $talents, $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}
	header("location: home.php");
}

else if($membership == 2){
	if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, image=?, bio=?, talents=? WHERE id=?")){
		$stmt->bind_param("sssssd", $phone, $businessphone, $image, $bio, $talents, $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}
	header("location: home.php");
}

else if($membership == 3){
	if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, image=?, video=?, bio=?,talents=? WHERE id=?")){
		$stmt->bind_param("ssssssd", $phone, $businessphone, $image, $video, $bio, $talents, $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}
	else{
		echo $mysqli->error;
	}
	header("location: home.php");
}

?>