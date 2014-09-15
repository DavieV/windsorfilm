<!DOCTYPE html>

<html>
	<?php
	include "includes/mainhead.html";
	?>

	<body>

		<!--Navigation Bar-->
		<?php
		include "includes/functions.php";
		include "includes/navbar.php";
		
		$name = $_POST['name'];
		$users = search($name);
		?>

		<div class="container">

			<?php foreach($users as $user): ?>

			<p>
				<?php if($user->hasImage()): ?>
					<?php $user->showImage(); ?>
				<?php endif; ?>
				<a href="profile.php?id=<?php echo $user->id; ?>"><?php echo $user->name; ?></a>
			</p>

			<?php endforeach; ?>
			
		</div>


	</body>
</html>