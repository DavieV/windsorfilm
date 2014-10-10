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
				<h1 id="red">Welcome</h1>
				<p>
					to the on-line community for the Windsor Centre for Film, Digital Media &amp; the Creative Arts, host of:
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
			The <span id="bold">Windsor Centre for Film, Digital Media &amp; Creative Arts</span> is dedicated to building the infrastructure to enhance opportunities for the development of film, television and all media arts in the greater Windsor/Detroit region. We understand that the <span id="bold">film industry crosses multiple sectors</span>, and we hope that you will join with us to build a <span id="bold">regional film and arts "on-line community"</span> that will help us attract filmmakers to our region.<br><br>
			Whether you are a director, producer, cinematographer, gaffer, assistant director, grip, make-up artist, set designer/builder, investor, accountant, lawyer, actor, hair stylist, professional volunteer or other interested in helping to diversify and build our regional "arts economy", we welcome you to our on-line community. The database is fully "searchable", and our goal is to nurture network connections between people who can work together for the greater good and expand job opportunities in the region.
			</p>		

			<button class="btn-lg btn-primary" data-toggle="modal" data-target="#search">Search the Database</button>

			<br><br>
			<p>
				There are several types of membership offered:
			</p>

			<button class="btn-lg btn-primary" data-toggle="modal" data-target="#instructions">Instructions</button>

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
							<li class="list-group-item features">500 character Bio (estimated 100 words)</li>
							<li class="list-group-item features"><span class="glyphicon glyphicon-remove"></span></li>
							<li class="list-group-item features"><span class="glyphicon glyphicon-remove"></span></li>
							<li class="list-group-item features"><a href="signup.php?t=1" target="blank"><button class="btn btn-primary">Sign up!</button></a></li>
						</ul>
					</div>
				</div>

				<div class="col-xs-12 col-md-4">
					<div class="panel panel-primary text-center">
						<div class="panel-heading">
							<h3 class="panel-title">Deluxe Membership</h3>
						</div>
						<div class="panel-body">
							<span class="price"><sup>$</sup>50</span> per year
						</div>
						<ul class="list-group">
							<li class="list-group-item features">Name</li>
							<li class="list-group-item features">Photo</li>
							<li class="list-group-item features">Contact Info</li>
							<li class="list-group-item features">5 Talent Areas</li>
							<li class="list-group-item features">1500 character Bio (estimated 300 words)</li>
							<li class="list-group-item features"><span class="glyphicon glyphicon-remove"></span></li>
							<li class="list-group-item features"><span class="glyphicon glyphicon-remove"></span></li>
							<li class="list-group-item features"><a href="signup.php?t=2" target="blank"><button class="btn btn-primary">Sign up!</button></a></li>
						</ul>
					</div>
				</div>

				<div class="col-xs-12 col-md-4">
					<div class="panel panel-primary text-center">
						<div class="panel-heading">
							<h3 class="panel-title">Premium Membership</h3>
						</div>
						<div class="panel-body">
							<span class="price"><sup>$</sup>100</span> per year
						</div>
						<ul class="list-group">
							<li class="list-group-item features">Name</li>
							<li class="list-group-item features">Photo</li>
							<li class="list-group-item features">Contact Info</li>
							<li class="list-group-item features">10 Talent Areas</li>
							<li class="list-group-item features">3000 character Bio (estimated 600 words)</li>
							<li class="list-group-item features">3 Minute Video</li>
							<li class="list-group-item features"><a data-toggle="modal" href="#raindance">Raindance International Premium Membership</a></li>
							<li class="list-group-item features"><a href="signup.php?t=3" target="blank"><button class="btn btn-primary">Sign up!</button></a></li>
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
	        		<h4 class="modal-title" id="myModalLabel">Instructions</h4>
	      		</div>
	      		<div class="modal-body">
	      			<p>
	      				1) In order to create a profile for our on-line community, you must first open an account by clicking the "Register" button at the top of the page.<br><br>
	      				2) After creating your account you will receive an email asking you to confirm your email address.  You must confirm your email address simply by clicking the link in the email sent to your inbox.<br><br>
	      				3) You can then select your level of membership by clicking the "Sign In!" button under the membership of your choice - $25, $50 or $100 a year.<br><br>
	      				4) Once your profile form is filled in, you can "Submit" to save and also pay by PayPal or Credit Card.<br><br>
						5) That's it!  You can see how your profile will appear to others by clicking the "My Profile" button at the top of the page.
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="raindance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        		<h4 class="modal-title" id="myModalLabel"><a href="https://www.raindance.org/premium/get-premium/?s2-ssl=yes ">Raindance International Premium Membership</a></h4>
	      		</div>
	      		<div class="modal-body">
	      			<p>
	      				Raindance International Premium Membership is included with the Premium Database Membership at no extra cost.<br><br>It includes:<br><br>
	      				<ul class="list-group">
	      					<li class="list-group-item">Free script registration</li>
	      					<li class="list-group-item">15% DISCOUNT on all courses</li>
	      					<li class="list-group-item">Access to all Raindance onlince courses and filmmaker resources</li>
	      					<li class="list-group-item">Access to legal contracts and documents</li>
	      					<li class="list-group-item">Free/discounted access to Raindance &amp; BIFA events</li>
	      				</ul>
	      			</p>
				</div>
			</div>
		</div>
	</div>

</html>