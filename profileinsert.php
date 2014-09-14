<?php
//Updates the database with the user's profile information after they fill out the form
session_start();

include "includes/dbconnect.php";
include "includes/functions.php";

$id = $_SESSION['id'];

$jobString = file_get_contents("pyscripts/jobs.txt");	/* Read in a list of viable talent values from text file */
$jobsArray = explode("\n", $jobString);					/* Separate each job value into an array */
$membership = getMembership($id);						/* int representing what account membership the user has */

$phone = htmlspecialchars($_POST['phone']);

/*
* The following variables are all optional parts of the profile form, so they are only assigned
* if the user has actually submitted the information
*/
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
	$talents = array($_POST['talent1'], $_POST['talent2'], $_POST['talent3']);
	if(validTalents($talents, $jobsArray)){
		if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, bio=?, talent1=?, talent2=?, talent3=? WHERE id=?")){
			$stmt->bind_param("ssssssd", $phone, $businessphone, $bio, $talents[0], $talents[1], $talents[2], $id);
			$stmt->execute();
			$stmt->close();
		}
		header("location: index.php");
	}
	echo "you goofed";
}

else if($membership == 2){
	$talents = array($_POST['talent1'], $_POST['talent2'], $_POST['talent3'], $_POST['talent4'], $_POST['talent5']);
	if(validTalents($talents, $jobsArray)){
		if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, image=?, bio=?, talent1=?, talent2=?, talent3=?, talent4=?, talent5=? WHERE id=?")){
			$stmt->bind_param("sssssssssd", $phone, $businessphone, $image, $bio, $talents[0], $talents[1], $talents[2], $talents[3], $talents[4], $id);
			$stmt->execute();
			$stmt->close();
		}
		header("location: index.php");
	}
	echo "you goofed";
}

else if($membership == 3){
	$talents = array($_POST['talent1'], $_POST['talent2'], $_POST['talent3'], $_POST['talent4'], $_POST['talent5'], $_POST['talent6'], $_POST['talent7']);
	if(validTalents($talents, $jobsArray)){
		if($stmt=$mysqli->prepare("UPDATE test SET phone=?, businessphone=?, image=?, video=?, bio=?, talent1=?, talent2=?, talent3=?, talent4=?, talent5=?, talent6=?, talent7=? WHERE id=?")){
			$stmt->bind_param("ssssssssssssd", $phone, $businessphone, $image, $video, $bio, $talents[0], $talents[1], $talents[2], $talents[3], $talents[4], $talents[5], $talents[6], $id);
			$stmt->execute();
			$stmt->close();
		}
		header("location: index.php");
	}
	echo "you goofed";
}