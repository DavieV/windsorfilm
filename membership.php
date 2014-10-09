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
?>

<!DOCTYPE html>

<html>

	<?php
	include "includes/mainhead.html";
	include "includes/dbconnect.php";
	?>

	<body>

		<?php include "includes/navbar.php"; ?>

		<div class="container">
			<div class="col-xs-12 col-md-6">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="F2XEZLJ3672QG">
					<table>
					<tr><td><input type="hidden" name="on0" value="Payment Options:">Payment Options:</td></tr><tr><td><select name="os0">
					<option value="Option 1" <?php if($_GET['t']==1) echo "selected" ?> >Option 1 : $25.00 CAD - yearly</option>
					<option value="Option 2" <?php if($_GET['t']==2) echo "selected" ?>>Option 2 : $50.00 CAD - yearly</option>
					<option value="Option 3" <?php if($_GET['t']==3) echo "selected" ?>>Option 3 : $100.00 CAD - yearly</option>
					</select> </td></tr>
					</table>
					<input type="hidden" name="currency_code" value="CAD">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
		</div>

		<div class="container">
			<p>
				Please note that it may take up to 48 hours for your membership status to update in order for you to fill out your profile information. An email will be sent to your registered address to notify you of this update.
			</p>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-4">
					<div class="panel panel-primary text-center">
						<div class="panel-heading">
							<h3 class="panel-title">Basic Membership</h3>
						</div>
						<div class="panel-body">
							<span class="price"><sup>$</sup>25</span> per year
						</div>
						<ul class="list-group">
							<li class="list-group-item features">Name</li>
							<li class="list-group-item features"><span class="glyphicon glyphicon-remove"></span></li>
							<li class="list-group-item features">Contact Info</li>
							<li class="list-group-item features">3 Talent Areas</li>
							<li class="list-group-item features">100 Word Bio</li>
							<li class="list-group-item features"><span class="glyphicon glyphicon-remove"></span></li>
						</ul>
					</div>
				</div>

				<div class="col-xs-12 col-md-4">
					<div class="panel panel-primary text-center">
						<div class="panel-heading">
							<h3 class="panel-title">Premium Membership</h3>
						</div>
						<div class="panel-body">
							<span class="price"><sup>$</sup>50</span> per year
						</div>
						<ul class="list-group">
							<li class="list-group-item features">Name</li>
							<li class="list-group-item features">Photo</li>
							<li class="list-group-item features">Contact Info</li>
							<li class="list-group-item features">5 Talent Areas</li>
							<li class="list-group-item features">300 Word Bio</li>
							<li class="list-group-item features"><span class="glyphicon glyphicon-remove"></span></li>
						</ul>
					</div>
				</div>

				<div class="col-xs-12 col-md-4">
					<div class="panel panel-primary text-center">
						<div class="panel-heading">
							<h3 class="panel-title">Deluxe Membership</h3>
						</div>
						<div class="panel-body">
							<span class="price"><sup>$</sup>100</span> per year
						</div>
						<ul class="list-group">
							<li class="list-group-item features">Name</li>
							<li class="list-group-item features">Photo</li>
							<li class="list-group-item features">Contact Info</li>
							<li class="list-group-item features">7 Talent Areas</li>
							<li class="list-group-item features">600 Word Bio</li>
							<li class="list-group-item features">3 Minute Video</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>