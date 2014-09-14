<?php 
include "includes/functions.php";

$currentUser=currentUser();

if(!$currentUser->isConfirmed()){
	header("location: reconfirm.php");
	die();
}
?>

<!DOCTYPE html>

<html>

	<?php
	include "includes/signinhead.html";

	$char=$currentUser->bioLength();
	?>

	<body>

		<div class="container">
			<form class="form-signin" role="form" action="profileinsert.php" method="post">
				<h2 class="form-sigin-heading">Please fill out your profile information.</h2>

				<input type="tel" class="form-control" name="phone" placeholder="Phone Number" value="<?php echo $currentUser->phone; ?>" required>

				<input type="tel" class="form-control" name="businessphone" placeholder="Business Phone Number" value="<?php echo $currentUser->bphone; ?>"><br>

				Input a short bio, <input readonly type="text" id='length' name="length" size="4" maxlength="4" value=<?php echo "'" . $char . "'"?>> characters left<br/>
				<textarea placeholder="Bio" onKeyDown=<?php echo '"textCounter(this,' . $char . ');"'?> onKeyUp=<?php echo '"textCounter(this,' . "'length'," . $char . ')"'?> name="bio" id="bio" rows="5" cols="34">
					<?php echo $currentUser->bio; ?>
				</textarea>

				<script>
				function textCounter(field, cnt, maxlimit) {         
					var cntfield = document.getElementById(cnt)	
				     if (field.value.length > maxlimit) // if too long...trim it!
						field.value = field.value.substring(0, maxlimit);
						// otherwise, update 'characters left' counter
						else
						cntfield.value = maxlimit - field.value.length;
				}
				</script>

				<?php if($currentUser->membership > 1): ?>
				
					<?php if($currentUser->hasImage()): ?>
						<img src="<?php echo $currentUser->image; ?>" width="100" height="100">
					<?php endif; ?>

					<input type='text' class='form-control' name='image' placeholder='Image URL'><br>
				<?php endif; ?>

				<?php
				//These if statements check the membership level of the user, and display the appropriate amount of selects
				for($i = 1; $i <= $currentUser->numTalents(); $i++): ?>
					Talent Area # <?php echo $i; ?>
					<select name='talent<?php echo $i; ?>"'>
					<?php include "includes/dropdown.html"; ?>
					</select><br><br>
				<?php endfor; ?>

				<?php if($currentUser->membership == 3): ?>
				<input type='text' class='form-control' name='video' placeholder='Youtube Video Address'>
				<?php endif; ?>

				<button class="btn btn-large btn-primary btn-block" type="submit">Submit</button>
			</form>
		</div>

	</body>