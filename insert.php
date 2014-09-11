<?php
/*
	Receives the user input from the registration form and adds their information
	to the database if there is not an existing user with the same username
*/
session_start();
include "includes/dbconnect.php";

/*
the htmlspecialchars function is used to prevent users from inputting html code into the database
*/
$email = htmlspecialchars($_POST['email']);
$firstname = ucwords(htmlspecialchars($_POST['firstname']));
$lastname = ucwords(htmlspecialchars($_POST['lastname']));
$password = hash("sha1", $_POST['password']);
$confirmpass = hash("sha1", $_POST['confirmpass']);

//query the database to see if there is an existing user with the same username
if($stmt=$mysqli->prepare("SELECT email FROM test WHERE email = ?")){
	$stmt->bind_param("s", $email);
	$stmt->bind_result($foundEmail);
	$stmt->execute();
	$stmt->fetch();
	$stmt->close();
}

$count=strlen($foundEmail) > 0; //becomes true if there is already a registered user with the same email address

if(strcmp($password, $confirmpass) == 0){ //check for proper registration formatting
	if(!$count){

		if($stmt=$mysqli->prepare("INSERT INTO test (email, firstname, lastname, password, verifycode) VALUES (?, ?, ?, ?, ?)")){
			$verifycode = md5(uniqid(rand(), true)); //generate a unique verification code
			$stmt->bind_param("sssss", $email, $firstname, $lastname, $password, $verifycode);
			$stmt->execute();
			$stmt->close();
		}

		if($stmt=$mysqli->prepare("SELECT id FROM test WHERE email = ?")){
			$stmt -> bind_param("s", $email);
			$stmt -> bind_result($id);
			$stmt -> execute();
			$stmt -> fetch();
			$stmt -> close();
			$_SESSION['login'] = "valid";
			$_SESSION['register'] = "valid";
			$_SESSION['id'] = $id;
			mail($email, "Confirm your E-mail address", "To confirm your e-mail address please click the following link:\nhttp://windsorfilmmaking.com/testing/confirm.php?h=" . $verifycode);
			header("location: index.php");
		}

	}
	else {
		$_SESSION['register'] = "taken";
		header("location: register.php");
	}	
}
else{
	$_SESSION['register'] = "invalid";
	header("location: register.php");
}


?>