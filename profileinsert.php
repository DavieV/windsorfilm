<?php
//Updates the database with the user's profile information after they fill out the form
session_start();

include "includes/dbconnect.php";
include "includes/functions.php";

$membership = getMembership($_SESSION['id']);

$firstname = htmlspecialchars($_POST['firstname']);
$lastname = htmlspecialchars($_POST['lastname']);
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

if($membership == 1){
	if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, bio=?, talent1=?, talent2=?, talent3=? WHERE id=?")){
		$stmt->bind_param("ssssssd", $phone, $businessphone, $bio, $_POST['talent1'], $_POST['talent2'], $_POST['talent3'], $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}
	header("location: index.php");
}

else if($membership == 2){
	if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, image=?, bio=?, talent1=?, talent2=?, talent3=?, talent4=?, talent5=? WHERE username=?")){
		$stmt->bind_param("sssssssssd", $phone, $businessphone, $image, $bio, $_POST['talent1'], $_POST['talent2'], $_POST['talent3'], $_POST['talent4'], $_POST['talent5'], $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}
	header("location: index.php");
}

else if($membership == 3){
	if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, image=?, video=?, bio=?, talent1=?, talent2=?, talent3=?, talent4=?, talent5=?, talent6=?, talent7=? WHERE username=?")){
		$stmt->bind_param("ssssssssssssd", $phone, $businessphone, $image, $video, $bio, $_POST['talent1'], $_POST['talent2'], $_POST['talent3'], $_POST['talent4'], $_POST['talent5'], $_POST['talent6'], $_POST['talent7'], $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}
	header("location: index.php");
}