<?php session_start(); ?>
<!DOCTYPE html>

<html>

	<?php
	include "includes/signinhead.html";
	?>

	<body>

		<div class="container">
			<div class="row">
				<?php
				if($_SESSION['register'] == "taken"){
				?>
					<div class="alert alert-danger col-xs-12 col-md-6 col-md-offset-3" role="alert">
						We're sorry, this e-mail address is already in use.
					</div>
				<?php
				}
				else if($_SESSION['register'] == "invalid"){
				?>
					<div class="alert alert-danger col-xs-12 col-md-6 col-md-offset-3" role="alert">
						Oops! Your passwords did not match one another.
					</div>
				<?php
				}
				?>
			</div>
		</div>

		<div>
			<form class="form-signin" role="form" action="insert.php" method="post">
				<h2 class="form-heading">Register an Account</h2>

				<input class="form-control" type="email" name="email" placeholder="E-mail Address" required autofocus>
				<input class="form-control" type="text" name="firstname" placeholder="First Name" required>
				<input class="form-control" type="text" name="lastname" placeholder="Last Name" required>
				<input class="form-control" type="password" name="password" placeholder="Password" required>
				<input class="form-control" type="password" name="confirmpass" placeholder="Confirm Password" required>
				
				<button class="btn btn-large btn-primary btn-block" type="submit">Submit</button>
			</form>
		</div>

	</body>
</html>