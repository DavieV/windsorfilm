<?php
session_start();
include "dbconnect.php";



function __autoload($class_name){
	include "classes/".$class_name.".php";
}

function currentUser(){
	if(isLogged())
		return new User($_SESSION['id']);
}


function isLogged(){
	return isset($_SESSION['id']);
}

function searchName($query){

	global $mysqli;

	$ids = array();
	$users=array();

	if($stmt=$mysqli->prepare("SELECT id FROM test WHERE UPPER(firstname) = UPPER(?)")){
		$stmt->bind_param("s", $query);
		$stmt->bind_result($id);
		$stmt->execute();
		while($stmt->fetch()){
			$ids[] = $id;
		}

		$stmt->close();
	}

	foreach($ids as $id)
		$users[]=new User($id);

	return $users;

}

function searchTalent($query){

	global $mysqli;

	$ids = array();
	$users=array();

	if($stmt=$mysqli->prepare("SELECT id FROM test WHERE talents LIKE ?")){
		$test="%".$query."%";
		$stmt->bind_param("s",$test);
		$stmt->bind_result($id);
		$stmt->execute();
		while($stmt->fetch()){
			$ids[]=$id;
		}

		$stmt->close();
	}

	foreach($ids as $id)
		$users[]=new User($id);

	return $users;

}

//Checks whether or not an array is composed of completely unique values
function uniqueVals($submitted){
	$map = array();
	foreach($submitted as $key){
		if(isset($map[$key])) return false;
		$map[$key] = 1;
	}
	return true;
}

/*
* Objective: Determine whether or not the submitted talent areas are valid
* Input: An array containing the submitted talents, as well as an array containing the valid ones
* Output: A boolean indicating whether all of the submitted talents are valid
*/
function validTalents($submitted){

	$jobString = file_get_contents("pyscripts/jobs.txt");	/* Read in a list of viable talent values from text file */
	$jobsArray = explode("\n", $jobString);					/* Separate each job value into an array */
	
	foreach($submitted as $talent){
		if(!in_array($talent, $jobsArray)){
			return false;
		}
	}
	return true;
}

function showError($error){
	$alert = "<div class='alert alert-danger col-xs-12 col-md-6 col-md-offset-3 text-center' role='alert'>";
	if(strcmp($error, "notLogged") == 0){
		echo $alert . "Sorry! You have to be logged in to access this page</div>";
	}
	elseif(strcmp($error, "confirmed") == 0){
		echo $alert . "You have already confirmed your email address!</div>";
	}
	elseif(strcmp($error, "taken") == 0){
		echo $alert . "We're sorry, this email address is already in use.</div>";
	}
	elseif(strcmp($error, "invalidSignup") == 0){
		echo $alert . "You have entered an invalid email address or passwords did not match.</div>";
	}
	elseif(strcmp($error, "invalidLogin") == 0){
		echo $alert . "Uh-Oh! You have entered an invalid email or password!</div>";
	}
	elseif(strcmp($error, "invalidTalents") == 0){
		echo $alert . "Nice try bud! That is an invalid talent area</div>";
	}
	elseif(strcmp($error, "repeat") == 0){
		echo $alert . "Oops! You cannot enter two or more of the same talent area</div>";
	}
	elseif(strcmp($error, "invalidBio") == 0){
		echo $alert . "So close! It seems you have exceeded the allowed length for your bio.</div>";
	}
	elseif(strcmp($error, "invalidImage") == 0){
		echo $alert . "Easy there Zark Fuckerberg, stop trying to hack our shit.</div>";
	}
}


?>