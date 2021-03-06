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

if(strcmp($password, $confirmpass) == 0 && filter_var($email, FILTER_VALIDATE_EMAIL)){ //check for proper registration formatting
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

			$subject = "Confirm your e-mail address";
			$msg = "To confirm your e-mail address please click the following link:\nhttp://windsorfilmmaking.com/talentdb/confirm.php?h=" . $verifycode;
			$headers = "From: administator@windsorfilmmaking.com";

			mail($email, $subject, $msg, $headers);
			$_SESSION['message'] = "Thank you for registering! You should receive a email to confirm your email address shortly.";
			header("location: index.php");
		}

	}
	else {
		$_SESSION['error'] = "We're sorry, this email address is already in use.";
		header("location: register.php");
	}	
}
else{
	$_SESSION['error'] = "You have entered an invalid email address or your passwords did not match.";
	header("location: register.php");
}


?>