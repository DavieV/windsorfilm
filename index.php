<?php 
include "includes/functions.php";
$currentUser = currentUser();
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
		if(isset($_SESSION['error'])){
			showError($_SESSION['error']);
			unset($_SESSION['error']);
		}
		if(isset($_SESSION['message'])){
			showMessage($_SESSION['message']);
			unset($_SESSION['message']);
		}
		?>

		<!--Main Jumbotron-->
		<div class="jumbotron">
			<div class="container">
				<h1>Welcome</h1>
				<p>
					to the online database for the Windsor Centre for Film, Digital Media &amp; the Creative Arts, host of:
				</p>
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<ul class="list-group">
							<li class="list-group-item"><a href="http://windsorfilmmaking.com/raindance-windsor-detroit/" target="_blank">Raindance Windsor-Detroit</a></li>
							<li class="list-group-item"><a href="http://windsorfilmmaking.com/filmcamp/" target="_blank">Film Camp For Kids</a> / <a href="http://windsorfilmmaking.com/filmcamp/" target="_blank">My Film Camp</a></li>
							<li class="list-group-item"><a href="http://windsorwc.org/" target="_blank">Windsor International Writers Conference</a></li>
							<li class="list-group-item">And more!</li>
						</ul>
					</div>
					<div class="col-xs-12 col-md-4 col-md-offset-2">
						<img height = "200" width="180" src="raindancelogo.png">
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<p>
			The <span id="bold">Windsor Centre for Film, Digital Media &amp; Creative Arts</span> is dedicated to building the infrastructure to enhance opportunities for the development of film, television and all media arts in the greater Windsor/Detroit region. We understand that the <span id="bold">film industry crosses multiple sectors</span>, and we hope that you will join with us to build an <span id="bold">regional film and arts "on-line community"</span> that will help us attract filmmakers to our region.<br><br>
			Whether you are a director, producer, cinematographer, set designer, make-up artist, set designer/builder, investor, accountant, lawyer, actor, hair stylist, professional volunteer or other interested in helping to diversify and build our regional "arts economy", we welcome you to our on-line community. The database is fully "searchable", and our goal is to nurture network connections between people who can work together for the greater good and expand job opportunities in the region.
			</p>		

			<button class="btn-lg btn-primary" data-toggle="modal" data-target="#search">Search the Database</button>

			<br><br>
			<p>
				There are several types of membership offered:
			</p>

			<button class="btn-lg btn-primary" data-toggle="modal" data-target="#instructions">Getting Started</button>

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
							<li class="list-group-item features"><span class="glyphicon glyphicon-remove"></span></li>
							<li class="list-group-item features"><a href="signup.php?t=1" target="blank"><button class="btn btn-primary">Sign up!</button></a>
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
							<li class="list-group-item features"><span class="glyphicon glyphicon-remove"></span></li>
							<li class="list-group-item features"><a href="signup.php?t=2" target="blank"><button class="btn btn-primary">Sign up!</button></a>
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
							<li class="list-group-item features">Raindance International Membership</li>
							<li class="list-group-item features"><a href="signup.php?t=3" target="blank"><button class="btn btn-primary">Sign up!</button></a>
						</ul>
					</div>
				</div>
			</div>

			<hr> <!--Separating Line-->

			<footer>
				<p>
					&copy; Windsor Centre for Film 2014
				</p>
			</footer>
		</div>

	</body>

	<div class="modal fade" id="instructions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        		<h4 class="modal-title" id="myModalLabel">Getting Started</h4>
	      		</div>
	      		<div class="modal-body">
	      			<p>
	      				1) In order to create a profile that will be added to our on-line community, you must first open an account by clicking the "Register" button at the top of the page.<br><br>
	      				2) After creating your account you should receive an email asking you to confirm your email address.  You must confirm your email address simply by clicking the link in the email sent to your in-box.<br><br>
	      				3) After confirming your email address you can pay for one of the three availabe membership options. It may take up to 48 hours for the membership status of your account to change, an email will be sent to you once your status has updated<br><br>
	      				4) Once your membership status has been updated you can fill out your profile information by clicking the "Edit Profile" button at the top of the page.<br><br>
	      				5) that's it! After filling out your profile information your profile shall go public, you can see how your profile appears to others by clicking the "My Profile" button at the top of the page.
					</p>
				</div>
			</div>
		</div>
	</div>

</html>