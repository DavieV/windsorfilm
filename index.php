<?php include "includes/functions.php"; ?>

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
		?>

		<!--Main Jumbotron-->
		<div class="jumbotron">
			<div class="container">
				<h1>Welcome,</h1>
				<p>
					to the online database for the Centre for Film, Digital Media &amp; the Creative Arts, host of:
				</p>
				<div class="col-xs-12 col-md-6">
					<ul class="list-group">
						<li class="list-group-item">Raindance Windsor-Detroit</li>
						<li class="list-group-item"><a href="http://filmcampforkids.com" target="_blank">Film Camp For Kids</a> / <a href="http://myfilmcamp.com" target="_blank">My Film Camp</a></li>
						<li class="list-group-item">Windsor International Writers Conference</li>
						<li class="list-group-item">And more!</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container">
				<p>
					The Centre is dedicated to building the infrastructure to enhance opportunities for the development of film, television and all media arts in the greater Windsor/Detroit region.  Whether you are a director, producer, cinematographer, actor, set designer, make-up artist, set designer/builder, investor in the arts or other, we welcome you to our on-line community. The database is fully "searchable", and our goal is to nurture network connections of people who can work together for the greater good and expand job opportunities in the region.
				</p>

				<p>
					There are several available for membership on this database:
				</p>

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
							<li class="list-group-item features"><a href="basic.php"><button class="btn btn-primary">Sign up!</button></a>
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
							<li class="list-group-item features"><a href="premium.php"><button class="btn btn-primary">Sign up!</button></a>
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
							<li class="list-group-item features"><a href="deluxe.php"><button class="btn btn-primary">Sign up!</button></a>
						</ul>
					</div>
				</div>
			</div>

			<hr> <!--Separating Line-->

			<footer>
				<p>
					&copy; Centre for Film 2014
				</p>
			</footer>
		</div>


	</body>
</html