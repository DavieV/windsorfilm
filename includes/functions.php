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

	if($stmt=$mysqli->prepare("SELECT id FROM test WHERE UPPER(firstname) = UPPER(?) AND membership > 0")){
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

	if($stmt=$mysqli->prepare("SELECT id FROM test WHERE talents LIKE ? AND membership > 0")){
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
		if(isset($map[$key]) && strcmp($key, "") != 0) return false;
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
		if(!in_array($talent, $jobsArray) && strcmp($talent, "") != 0){
			return false;
		}
	}
	return true;
}

function showError($error){
	$alert = "<div class='alert alert-danger col-xs-12 col-md-6 col-md-offset-3 text-center' role='alert'>";
	echo $alert . $error . "</div>";
}

function showMessage($message){
	$alert = "<div class='alert alert-success col-xs-12 col-md-6 col-md-offset-3 text-center' role='alert'>";
	echo $alert . $message . "</div>";
}

?>