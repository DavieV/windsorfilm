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
	$char=$currentUser->bioLength();
	?>

	<body>

		<div class="container">
			<form class="form-signin" role="form" action="profileinsert.php" method="post">
				<h2 class="form-sigin-heading">Please fill out your profile information.</h2>

				<input type="tel" class="form-control" name="phone" placeholder="Phone Number" value="<?php echo $currentUser->phone; ?>" required>
				<input type="tel" class="form-control" name="businessphone" placeholder="Business Phone Number" value="<?php echo $currentUser->bphone; ?>"><br>
				<input class="form-control" name="city" placeholder="City" value="<?php echo $currentUser->city; ?>"><br>
				<input class="form-control" name="company" placeholder="Company Name" value="<?php echo $currentUser->company; ?>"><br>
				<input class="form-control" name="website" placeholder="Website" value="<?php echo $currentUser->website; ?>"><br>
				<br /><br />

				Input a short bio, <input readonly type="text" id='length' name="length" size="4" maxlength="4" value=<?php echo "'" . $char . "'"?>> characters left<br/>

				<!-- dont space this out, it will cause unwanted white space in the text area -->
				<textarea placeholder="Bio" onKeyDown=<?php echo '"textCounter(this,' . $char . ');"'?> onKeyUp=<?php echo '"textCounter(this,' . "'length'," . $char . ')"'?> name="bio" id="bio" rows="5" cols="34"><?php echo $currentUser->bio; ?></textarea>

				<?php if($currentUser->membership > 1): ?>

					<?php if($currentUser->hasImage()): ?>
						<?php $currentUser->showImage("200","200","img-center"); ?>
					<?php endif; ?>

					<input type='text' class='form-control' name='image' placeholder='Image URL' value="<?php echo $currentUser->image; ?>"><br>
				<?php endif; ?>

				<?php
				//These if statements check the membership level of the user, and display the appropriate amount of selects
				for($i = 1; $i <= $currentUser->numTalents(); $i++): ?>
					Talent Area # <?php echo $i; ?>
					<select name='talent<?php echo $i; ?>'>
					<?php include "includes/dropdown.html"; ?>
					</select><br><br>
				<?php endfor; ?>

				<?php if($currentUser->membership == 3): ?>
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

//Makes the default values on the dropdowns match the ones that the user's have already selected on 
//previous uses of the form
function defaultTalents(talents){
	var talArray=talents.split(",");
	for(var i=1;i<=talArray.length;i++){
		$("select[name='talent"+i+"'] option[value='"+talArray[i-1]+"']").attr("selected",true)
	}
}

defaultTalents("<?php echo implode(',',$currentUser->talents); ?>");
</script>