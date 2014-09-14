<?php session_start(); ?>

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
		$ids = search($name);
		?>

		<div class="container">

			<?php
			foreach($ids as $id){
			?>

			<p><a href="profile.php?id=<?php echo $id; ?>"><?php echo getName($id); ?></a></p>

			<?php
			}
			?>
			
		</div>


	</body>
</html>