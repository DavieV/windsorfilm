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
	mail($email, "Confirm your E-mail address", "To confirm your e-mail address please click the following link:\nhttp://windsorfilmmaking.com/testing/confirm.php?h=" . $verifycode);
	header("location: index.php");
?>