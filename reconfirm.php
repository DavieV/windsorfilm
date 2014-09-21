<?php 
include "includes/functions.php";

$currentUser = currentUser();

if(!isset($currentUser->id)){		/* Redirect if the user is not signed in */
	$_SESSION['error'] = "Sorry! You have to be logged in to access this page";
	header("location: index.php");
	die();
}
if($currentUser->isConfirmed()){	/* Redirect if the user has already confirmed their e-mail */
	$_SESSION['error'] = "You have already confirmed your email address!";
	header("location: index.php");
	die();
}
?>

<!DOCTYPE html>

<html>
	
	<?php
	include "includes/mainhead.html";
	?>

	<body>

		<!--Navigation Bar-->
		<?php
		include "includes/navbar.php";
		?>

		<div class="container">
			<div class='alert alert-danger col-xs-12 col-md-6 col-md-offset-3 text-center' role='alert'> 
				Uh Oh! You have not yet confirmed your e-mail address!
			</div>
		</div>

		<div class="container">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<p>
					In order to order to make use of some of the features on the site such as editing or viewing you profile, you must first confirm your e-mail address. In order to do so simply click the link in the e-mail that has been sent to you.
				</p>
				<p>
				 	If you have not yet received a confirmation, or would like to be sent another verification code then please click <a href='regen.php'>here.</a>
				</p>
			</div>
		</div>
	</body>
</html>