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
}

if(strlen($_POST['bio'])){
	$bio = htmlspecialchars($_POST['bio']);
}



$submittedTalents=array();

for($i=1;$i<=$currentUser->numTalents();$i++) //build an array of the submitted talents
	$submittedTalents[]=$_POST['talent'.$i];  //will be checked against valid talents to prevent value editing

if(!validTalents($submittedTalents)){
	header("location: profileform.php");
	die();
}


if($membership == 1){
	if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, bio=?, talent1=?, talent2=?, talent3=? WHERE id=?")){
		$stmt->bind_param("ssssssd", $phone, $businessphone, $bio, $_POST['talent1'], $_POST['talent2'], $_POST['talent3'], $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}
	header("location: index.php");
}

else if($membership == 2){
	if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, image=?, bio=?, talent1=?, talent2=?, talent3=?, talent4=?, talent5=? WHERE id=?")){
		$stmt->bind_param("sssssssssd", $phone, $businessphone, $image, $bio, $_POST['talent1'], $_POST['talent2'], $_POST['talent3'], $_POST['talent4'], $_POST['talent5'], $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}
	header("location: index.php");
}

else if($membership == 3){
	if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, image=?, video=?, bio=?, talent1=?, talent2=?, talent3=?, talent4=?, talent5=?, talent6=?, talent7=? WHERE id=?")){
		$stmt->bind_param("ssssssssssssd", $phone, $businessphone, $image, $video, $bio, $_POST['talent1'], $_POST['talent2'], $_POST['talent3'], $_POST['talent4'], $_POST['talent5'], $_POST['talent6'], $_POST['talent7'], $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}
	else{
		echo $mysqli->error;
	}
	header("location: home.php");
}

?>