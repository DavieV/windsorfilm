<?php
session_start();
/*
	Gets the verify code from the URL which has been e-mailed to the user, and queries
	the database to find the user with the same code. If query returns a value then the
	'confirmed' field of the database is set to true.
*/

include "includes/dbconnect.php";

$hash = $_GET['h']; //get the verify code which is embedded in the URL

if($stmt=$mysqli->prepare("SELECT id FROM test WHERE verifycode = ?")){
	$stmt->bind_param("s", $hash);
	$stmt->execute();
	$stmt->bind_result($id);
	$stmt->fetch();
	$stmt->close();
}
	
if($id > 0){
	$mysqli->query("UPDATE test SET confirmed=1 WHERE id=".$id);
}

$_SESSION['message'] = "Thank you, your email address has been confirmed.";

header("location: index.php")
?>