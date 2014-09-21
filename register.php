<?php include "includes/functions.php"; ?>
<!DOCTYPE html>

<html>

	<?php
	include "includes/signinhead.html";
	if(isset($_SESSION['error'])){
		showError($_SESSION['error']);
		unset($_SESSION['error']);
	}
	?>

	<body>

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