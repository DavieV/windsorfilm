<?php 
include "includes/functions.php";

if(!isset($_SESSION['id'])){
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
			<?php
			$confirmed = getConfirmed($_SESSION['id']);
			if(!$confirmed){
			?>
			<div class='alert alert-danger col-xs-12 col-md-6 col-md-offset-3 text-center' role='alert'> 
				Uh Oh! You have not yet confirmed your e-mail address!
			</div>
			<?php
			}
			?>
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