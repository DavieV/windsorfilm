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

$type = $_GET['t'];
if($char=$currentUser->bioLength() > 0) $char = $currentUser->bioLength();
else{
	if($type == 1) $char = 500;
	elseif($type == 2) $char = 1500;
	elseif($type == 3) $char = 3000;
	else{
		$_SESSION['error'] = "Invalid form request";
		header("location: index.php");
		echo $type;
		die();
	} 
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
	?>


	<body>

		<div class="container">
			<form class="form-signin" role="form" action="profileinsert.php?t=<?php echo $type; ?>" method="post">
				<h2 class="form-sigin-heading">Please fill out your profile information.</h2>

				<input type="tel" class="form-control" name="phone" placeholder="Phone Number" required>
				<input type="tel" class="form-control" name="businessphone" placeholder="Business Phone Number"><br>
				<input class="form-control" name="city" placeholder="City"><br>
				<input class="form-control" name="company" placeholder="Company Name"><br>
				<input class="form-control" name="website" placeholder="Website"><br>
				<br /><br />

				Input a short bio, <input readonly type="text" id='length' name="length" size="4" maxlength="4" value=<?php echo "'" . $char . "'"?>> characters left<br/>

				<!-- dont space this out, it will cause unwanted white space in the text area -->
				<textarea placeholder="Bio" onKeyDown=<?php echo '"textCounter(this,' . $char . ');"'?> onKeyUp=<?php echo '"textCounter(this,' . "'length'," . $char . ')"'?> name="bio" id="bio" rows="5" cols="34"></textarea>

				<?php if($type > 1): ?>
					<input type='text' class='form-control' name='image' placeholder='Image URL'><br>
				<?php endif; ?>

				<?php if($type == 1): ?>
					<?php for($i = 1; $i <= 3; $i++): ?>
						Talent Area # <?php echo $i; ?>
						<select name='talent<?php echo $i; ?>'>
						<?php include "includes/dropdown.html"; ?>
						</select><br><br>
					<?php endfor; ?>
				<?php elseif($type == 2): ?>
					<?php for($i = 1; $i <= 5; $i++): ?>
						Talent Area # <?php echo $i; ?>
						<select name='talent<?php echo $i; ?>'>
						<?php include "includes/dropdown.html"; ?>
						</select><br><br>
					<?php endfor; ?>
				<?php elseif($type == 3): ?>
					<?php for($i = 1; $i <= 10; $i++): ?>
						Talent Area # <?php echo $i; ?>
						<select name='talent<?php echo $i; ?>'>
						<?php include "includes/dropdown.html"; ?>
						</select><br><br>
					<?php endfor; ?>
				<?php endif ?>

				<?php if($type == 3): ?>
				<input type='text' class='form-control' name='video' placeholder='Youtube Video Address' value="<?php echo $currentUser->video; ?>">
				<?php endif; ?>

				<button class="btn btn-large btn-primary btn-block" type="submit">Submit</button>
			</form>
		</div>

	</body>
</html>

<script>
//Counts the number of characters that the user entered into the text area and display how many more characters
//they can enter based on a limit. Deletes any characters that have been added once the limit is exceeded.
function textCounter(field, cnt, maxlimit) {         
	var cntfield = document.getElementById(cnt)	
     if (field.value.length > maxlimit) // if too long...trim it!
		field.value = field.value.substring(0, maxlimit);
		// otherwise, update 'characters left' counter
		else
		cntfield.value = maxlimit - field.value.length;
}
</script>