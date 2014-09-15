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

function search($searchName){
	global $mysqli;

	$ids = array();
	$users=array();

	if($stmt=$mysqli->prepare("SELECT id FROM test WHERE UPPER(firstname) = UPPER(?)")){
		$stmt->bind_param("s", $searchName);
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


?>