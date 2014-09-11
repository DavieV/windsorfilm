<?php 
session_start();
include "includes/functions.php";
$confirmed = getConfirmed($_SESSION['id']); //flag representing whether the user has confirmed their email
if(!$confirmed){
	header("location: reconfirm.php");
}
?>

<!DOCTYPE html>

<html>

	<?php
	include "includes/signinhead.html";
	include "includes/functions.php";
	$membership = getMembership($_SESSION['id']);
	if($membership == 1) $char = 500;
	else if($membership == 2) $char = 1500;
	else if($membership == 3) $char = 3000;
	?>

	<body>

		<div class="container">
			<form class="form-signin" role="form" action="profileinsert.php" method="post">
				<h2 class="form-sigin-heading">Please fill out your profile information.</h2>
				<input type="tel" class="form-control" name="phone" placeholder="Phone Number" required>
				<input type="tel" class="form-control" name="businessphone" placeholder="Business Phone Number"><br>
				Input a short bio, <input readonly type="text" id='length' name="length" size="4" maxlength="4" value=<?php echo "'" . $char . "'"?>> characters left<br/>
				<textarea placeholder="Bio" onKeyDown=<?php echo '"textCounter(this,' . $char . ');"'?> onKeyUp=<?php echo '"textCounter(this,' . "'length'," . $char . ')"'?> name="bio" id="bio" rows="5" cols="34"></textarea>

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
				<!--**Put php here that checks if user has a level 2 or 3 membership, if so include a photo upload field**-->
				<?php
				if($membership > 1){
					echo "<input type='text' class='form-control' name='image' placeholder='Image URL'><br>";
				}
				?>
				<?php
				//These if statements check the membership level of the user, and display the appropriate amount of selects
				if($membership == 1){
					for($i = 0; $i < 3; $i++){
						echo "Talent Area #" . ($i + 1);
						echo "<select name='talent" . ($i + 1) . "'>";
						include "includes/dropdown.html";
						echo "</select><br><br>";
					}
				}

				else if($membership == 2){
					for($i = 0; $i < 5; $i++){
						echo "Talent Area #" . ($i + 1);
						echo "<select name='talent" . ($i + 1) . "'>";
						include "includes/dropdown.html";
						echo "</select><br><br>";
					}
				}

				else if($membership == 3){
					for($i = 0; $i < 7; $i++){
						echo "Talent Area #" . ($i + 1);
						echo "<select name='talent" . ($i + 1) . "'>";
						include "includes/dropdown.html";
						echo "</select><br><br>";
					}
				}
				?>
				<?php
				if($membership == 3){
					echo "<input type='text' class='form-control' name='video' placeholder='Youtube Video Address'>";
				}
				?>
				<button class="btn btn-large btn-primary btn-block" type="submit">Submit</button>
			</form>
		</div>

	</body>