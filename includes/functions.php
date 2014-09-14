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


/*
Objective: Query the database and gather the talent areas of a particular user
Input: The id which is used to query the database
Output: An array containing all of the user's talent areas
*/
function getTalents($id){
	global $mysqli;
	if($stmt=$mysqli->prepare("SELECT talent1, talent2, talent3, talent4, talent5, talent6, talent7 FROM test WHERE id=?")){
		$stmt->bind_param("d", $id);
		$stmt->bind_result($talent1, $talent2, $talent3, $talent4, $talent5, $talent6, $talent7);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
	}
	$tmp=array($talent1, $talent2, $talent3, $talent4, $talent5, $talent6, $talent7);
	for($i = 0; $i < count($tmp); $i++){
		$tmp[$i] = htmlspecialchars($tmp[$i]);
	}
	return $tmp;
}

function getMembership($id){
	global $mysqli;
	if($stmt=$mysqli->prepare("SELECT membership FROM test WHERE id=?")){
		$stmt->bind_param("d", $id);
		$stmt->bind_result($membership);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
	}
	return $membership;
}

function search($searchName){
	global $mysqli;

	$ids = array();

	if($stmt=$mysqli->prepare("SELECT id, firstname, lastname FROM test WHERE UPPER(firstname) = UPPER(?)")){
		$stmt->bind_param("s", $searchName);
		$stmt->bind_result($id, $first, $last);
		$stmt->execute();
		while($stmt->fetch()){
			$ids[] = $id;
		}

		$stmt->close();
	}

	return $ids;
}
?>