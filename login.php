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
	
		<div class="container">
			<form class="form-signin" role="form" action="checklogin.php" method="post">
				<h2 class="form-signin-heading">Please Sign in</h2>

				<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
				<input type="email" class="form-control" name="email" placeholder="E-mail Address" required autofocus>

				<span class="input-group-addon"><span class="glyphicon glyphicon-star"></span></span>
				<input type="password" class="form-control" name="password" placeholder="Password" required>

				<button class="btn btn-large btn-primary btn-block" type="submit">Submit</button>
			</form>
		</div>

	</body>
</html>