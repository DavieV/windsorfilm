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
		
		$name = $_GET['name'];
		$users = search($name);
		?>

		<?php foreach($users as $user): ?>
		<div class="container">
			<div class="row">
				
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<a href="profile.php?id=<?php echo $user->id; ?>"><?php echo $user->name; ?></a>
						</div>
						<div class="panel-body">
							<div class="col-xs-12 col-md-6">
								<?php if($user->hasImage()): ?>
									<a href="profile.php?id=<?php echo $user->id; ?>">
									<?php $user->showImage(); ?>
									</a>
								<?php else: ?>
									<a href="profile.php?id=<?php echo $user->id; ?>"><img src="noimage.png" width="200" height="200"></a>
								<?php endif; ?>
							</div>

							<div class="col-xs-12 col-md-6">
								<ul class="basic">
								<?php 
								foreach($user->talents as $talent){
									echo "<li>" . $talent . "</li>";
								}
								?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>


	</body>
</html>