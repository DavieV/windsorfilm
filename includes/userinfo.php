<!DOCTYPE html>
<html>
	
	<?php
	include "includes/mainhead.html";
	?>

	<body>

		<?php
		//Navigavtion Bar
		include "includes/navbar.php";
		?>

		<div class="jumbotron">
			<div class="container">
				<div class="row">
					<?php if($currentUser->hasImage()): ?>
						<?php $currentUser->showImage("15%","80%"); ?>
					<?php endif; ?>
					<br /><br />
					<span class="heading">
						<h1><?php echo $currentUser->name; ?></h1>
					</span>
				</div>
			</div>
		 </div>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="panel panel-primary text-center">
						<div class="panel-heading">
							<h3 class="panel-title">Contact Information</h3>
						</div>
						<ul class="list-group">
							<li class="list-group-item"><span class="glyphicon glyphicon-envelope"></span>Email Address:<br /><?php echo $currentUser->email; ?></li>
							<li class="list-group-item"><span class="glyphicon glyphicon-earphone"></span>Phone Number <br /><?php $currentUser->showPhone(); ?></li>
							<?php if($currentUser->hasBusinessPhone()): ?>
							<li class="list-group-item"><span class="glyphicon glyphicon-phone-alt"></span>
								Business Phone: <br />
								<?php $currentUser->showBPhone(); ?>
							</li>
							<?php endif; ?>
							<li class="list-group-item">City: <br><?php echo $currentUser->city; ?></li>
							<li class="list-group-item">Company Name: <br><?php echo $currentUser->company; ?></li>
							<li class="list-group-item">Website: <br><a href="http://<?php echo $currentUser->website; ?>"><?php echo $currentUser->website; ?></a></li>
						</ul>
						<div class="panel-heading">
							<h3 class="panel-title">Talent Areas</h3>
						</div>
						<ul class="list-group">
							<?php foreach($currentUser->talents as $talent): ?>
								<?php if(strcmp($talent, "") != 0): ?>
									<li class='list-group-item'><?php echo $talent; ?></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>

				<div class="col-xs-12 col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading text-center">
							<h3 class="panel-title">About</h3>
						</div>
						<div class="panel-body">
							<p>
								<?php if($currentUser->hasBio()): ?>
									<?php echo $currentUser->bio; ?>
								<?php else: ?>
									This person has not written a bio yet
								<?php endif; ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-10 col-md-offset-1">
					<?php if($currentUser->hasVideo()): ?>
							<div class='embed-responsive embed-responsive-16by9'>
							<?php echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe class='embed-responsive-item' src=\"//www.youtube.com/embed/$1\"></iframe>", $currentUser->video); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

	</body>
</html>