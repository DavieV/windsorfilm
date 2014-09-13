<?php
	session_start();
	include "includes/dbconnect.php";

	$verifycode = md5(uniqid(rand(), true)); //generate a unique verification code

	if($stmt=$mysqli->prepare("SELECT email FROM test WHERE id = ?")){
		$stmt->bind_param("d", $_SESSION['id']);
		$stmt->bind_result($email);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
	}

	if($stmt=$mysqli->prepare("UPDATE test SET verifycode = ? WHERE id = ?")){
		$stmt->bind_param("sd", $verifycode, $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
	}

	$subject = "Confirm your e-mail address";
	$msg = "To confirm your e-mail address please click the following link:\nhttp://windsorfilmmaking.com/testing/confirm.php?h=" . $verifycode;
	$headers = "From: administator@windsorfilmmaking.com";

	mail($email, $subject, $msg, $headers);
	
	header("location: index.php");
?>