<?php 
include "includes/functions.php";

$currentUser=currentUser();

if(!isset($currentUser->id)){		/* Redirect if the user is not signed in */
	$_SESSION['error'] = "You have to be logged in to access this page.";
	header("location: index.php");
	die();
}
if(!$currentUser->isConfirmed()){		/* Redirect if the user has not confirmed their email address */
	header("location: reconfirm.php");
	die();
}
if($currentUser->membership == 0){
	$_SESSION['error'] = "You have to sign up for a membership to create your user profile.";
	header("location: index.php");
	die();
}
?>

<!DOCTYPE html>

<html>

	<?php
	include "includes/signinhead.html";
	if(isset($_SESSION['error'])){
		showError($_SESSION['error']);
		unset($_SESSION['error']);
	}
	$char=500;
	?>

	<body>

		<div class="container">
			<form class="form-signin" role="form" action="membershipinsert.php" method="post">
				<h2 class="form-sigin-heading">Please fill out your profile information.</h2>

				<input type="tel" class="form-control" name="phone" placeholder="Phone Number" required>
				<input type="tel" class="form-control" name="businessphone" placeholder="Business Phone Number"><br>
				<br /><br />

				Input a short bio, <input readonly type="text" id='length' name="length" size="4" maxlength="4" value=<?php echo "'" . $char . "'"?>> characters left<br/>

				<!-- dont space this out, it will cause unwanted white space in the text area -->
				<textarea placeholder="Bio" onKeyDown=<?php echo '"textCounter(this,' . $char . ');"'?> onKeyUp=<?php echo '"textCounter(this,' . "'length'," . $char . ')"'?> name="bio" id="bio" rows="5" cols="34"></textarea>

				<?php
				//These if statements check the membership level of the user, and display the appropriate amount of selects
				for($i = 1; $i <= 3; $i++): ?>
					Talent Area # <?php echo $i; ?>
					<select name='talent<?php echo $i; ?>'>
					<?php include "includes/dropdown.html"; ?>
					</select><br><br>
				<?php endfor; ?>

				<button class="btn btn-large btn-primary btn-block" type="submit">Submit</button>
			</form>
		</div>

	</body>
</html>