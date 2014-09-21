<?php
/*
	Queries the Database with the submitted e-mail and password, if the query
	returns a value then the login information is valid and the user is redirected
*/
session_start();
include "includes/dbconnect.php";

$email = $_POST['email'];
$password = hash("sha1", $_POST['password']);

if($stmt=$mysqli->prepare("SELECT id FROM test WHERE email = ? AND password = ?")){
	$stmt->bind_param("ss", $email, $password);
	$stmt->bind_result($id);
	$stmt->execute();
	$stmt->fetch();
	$stmt->close();
}

if($id > 0){						/* Check that the returned id is valid */
	$_SESSION['id'] = $id;
	header("location: index.php");
}

else {
	$_SESSION['error'] = "Uh-Oh! You have entered an invalid email or password!";
	header("location: login.php");
}
?>