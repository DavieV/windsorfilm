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
?>