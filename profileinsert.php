<?php

/*

	TODO:
	Clean this file up


*/

//Updates the database with the user's profile information after they fill out the form
include "includes/functions.php";

$currentUser=currentUser();

$membership = $currentUser->membership;
$signup = false;

if($membership == 0 && isset($_GET['t']) && $_GET['t'] >= 1 && $_GET['t'] <= 3){
	$membership = $_GET['t'];
	$signup = true;
}
elseif($membership == 0) {
	$_SESSION['error'] = "Unexpected profile submission.";
	header("location: index.php");
	die();
}

//profile image
//have to strip punctuation from the string
$phone = htmlspecialchars($_POST['phone']);
$phone = str_replace(array("-", "." , ",", "(", ")", "[", "]"), "", $phone); //****TODO***** replace with my own function
$businessphone = htmlspecialchars($_POST['businessphone']);
$businessphone = str_replace(array("-", "." , ",", "(", ")", "[", "]"), "", $businessphone);
$city = htmlspecialchars($_POST['city']);
$company = htmlspecialchars($_POST['company']);
$website = htmlspecialchars($_POST['website']);

if(isset($_POST['video'])){
	$video = htmlspecialchars($_POST['video']);
}

if(strlen($_POST['image']) > 0){
	$image = htmlspecialchars($_POST['image']);
	//this prevents people from adding their own attributes to images, e.x. http://test.com/image ' height=1000
	if (filter_var($image, FILTER_VALIDATE_URL) === FALSE){	/* Redirect if the user tried to hack the image field */
		$_SESSION['error'] = "Invalid URL, (Did you forget to include http://) ?";
		header("location: profileform.php");
		die();
	}
}

if(strlen($_POST['bio'])>0){
	$bio = htmlspecialchars($_POST['bio']);
	if(strlen($bio)>$currentUser->bioLength() && !$signup){	/* Redirect if the user has entered a bio longer than their allowed length */
		$_SESSION['error'] = "So close! It seems you have exceeded the allowed length for your bio.";
		header("location: profileform.php");
		die();
	}
	else{
		if($membership == 1 && strlen($bio) > 500){
			$_SESSION['error'] = "So close! It seems you have exceeded the allowed length for your bio.";
			header("location: index.php");
			die();
		}
		elseif($membership == 2 && strlen($bio) > 1500){
			$_SESSION['error'] = "So close! It seems you have exceeded the allowed length for your bio.";
			header("location: index.php");
			die();
		}
		elseif($membership == 3 && strlen($bio) > 3000){
			$_SESSION['error'] = "So close! It seems you have exceeded the allowed length for your bio.";
			header("location: index.php");
			die();
		}
	}
}


$submittedTalents=array();

if(!$signup){
	for($i=1;$i<=$currentUser->numTalents();$i++) 	//build an array of the submitted talents
		$submittedTalents[]=$_POST['talent'.$i];  	//will be checked against valid talents to prevent value editing
}
else{
	if($membership == 1){
		for($i=1;$i<=3;$i++){
			$submittedTalents[]=$_POST['talent'.$i];
		}
	}
	elseif($membership == 2){
		for($i=1;$i<=5;$i++){
			$submittedTalents[]=$_POST['talent'.$i];
		}
	}
	elseif($membership == 3){
		for($i=1;$i<=10;$i++){
			$submittedTalents[]=$_POST['talent'.$i];
		}
	}
}

if(!validTalents($submittedTalents)){			/* Redirect if the user submitted invalid talents */
	$_SESSION['error'] = "That is an invalid talent area";
	header("location: profileform.php");
	die();
}

if(!uniqueVals($submittedTalents)){				/* Redirect if the user has submitted repeated talents */
	$_SESSION['error'] = "Oops! You cannot enter two or more of the same talent area";
	header("location: profileform.php");
	die();
}

$talents=implode(",", $submittedTalents); //if they pass validation, generate the string



/*


Lets try to short this to 1 query if possible

there has to be a nicer way than this


*/
if($membership == 1){
	if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, city=?, company=?, website=?, bio=?, talents=? WHERE id=?")){
		$stmt->bind_param("sssssssd", $phone, $businessphone, $city, $company, $website, $bio, $talents, $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}
}

else if($membership == 2){
	if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, city=?, company=?, website=? image=?, bio=?, talents=? WHERE id=?")){
		$stmt->bind_param("ssssssssd", $phone, $businessphone, $city, $company, $website, $image, $bio, $talents, $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}
}

else if($membership == 3){
	if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, city=?, company=?, website=? image=?, video=?, bio=?,talents=? WHERE id=?")){
		$stmt->bind_param("sssssssssd", $phone, $businessphone, $city, $company, $website, $image, $video, $bio, $talents, $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}
	
}
if($signup){
	header("location: membership.php?t=".$_GET['t']);
	die();
}
header("location: home.php");
?>