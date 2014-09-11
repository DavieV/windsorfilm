<?php

include "dbconnect.php";

/*
Objective: Return an array containing all of the users contact information
Input: The id which is used to query the database
Output: An array containing the user's contact information
*/
function getInfo($id){
	global $mysqli;
	if($stmt=$mysqli->prepare("SELECT firstname, lastname, phone, businessphone, email, image, video, bio FROM test WHERE id=?")){
		$stmt->bind_param("d", $id);
		$stmt->bind_result($firstname, $lastname, $phone, $businessphone, $email, $image, $video, $bio);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
	}
	return array($firstname, $lastname, $phone, $businessphone, $email, $image, $video, $bio);
}

function getName($id){
	global $mysqli;
	if($stmt=$mysqli->prepare("SELECT firstname, lastname FROM test WHERE id=?")){
		$stmt->bind_param("d", $id);
		$stmt->bind_result($firstname, $lastname);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
	}
	return $firstname . " " . $lastname;
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

/*
Objective: Determine whether or not a particular user has confirmed their email address
Input: The id which is used in order to query the database
Output: A boolean representing whether or not the user's email address has been confirmed
*/
function getConfirmed($id){
	global $mysqli;
	if($stmt=$mysqli->prepare("SELECT confirmed FROM test WHERE id=?")){
		$stmt->bind_param("d", $id);
		$stmt->bind_result($confirmed);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
	}
	return $confirmed;
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