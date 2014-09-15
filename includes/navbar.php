<?php
/*
Navbar which is included at the top of most of the pages.
Checks if the user is logged in or not, displaying appropriate buttons
based on the their login status. Includes modals for signing in and
searching the database.
*/
?>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
  			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
  			</button>
  			<a class="navbar-brand" href="index.php">Windsor Centre for Film</a>
		</div>
		<?php
		//only display the login form if there isn't a user logged in already
		if(isset($_SESSION['id'])){
		?>

		<div class="navbar-collapse collapse">
			<div class="navbar-right">
				<span class='navtext'>Welcome <?php echo currentUser()->name; ?>!</span>
				<a href="home.php"><button class="btn btn-primary">My Profile</button></a>
				<a href="logout.php"><button class="btn btn-primary">Logout</button></a>
				<button class="btn btn-primary" data-toggle="modal" data-target="#search">Search</button>
			</div>
		</div>

		<?php 
		}
		else{
		?>

		<div class="navbar-collapse collapse">
			<div class="navbar-right">
				<button class="btn btn-primary" data-toggle="modal" data-target="#signin">Sign In</button>
				<button class="btn btn-primary" data-toggle="modal" data-target="#search">Search</button>
				<?php
				if(!isset($_SESSION['id'])){				
				?>
				<button class="btn btn-primary" data-toggle="modal" data-target="#signup">Sign Up</button>
				<?php
				}
				?>
			</div>
		</div>

		<?php } ?>
	</div>
</div>

<!-- Sign In Modal -->
<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel">Please Sign In</h4>
      		</div>
      		<div class="modal-body">
				<form class="form-signin" role="form" action="checklogin.php" method="post">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<input type="email" class="form-control" name="email" placeholder="E-mail Address" required autofocus>

					<span class="input-group-addon"><span class="glyphicon glyphicon-star"></span></span>
					<input type="password" class="form-control" name="password" placeholder="Password" required>

					<button class="btn btn-large btn-primary btn-block" type="submit">Submit</button>
				</form>
      		</div>
    	</div>
  	</div>
</div>

<!--Search Modal-->
<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel">Search the Database</h4>
      		</div>
      		<div class="modal-body">
				<form class="form-signin" role="form" action="results.php" method="post">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<input type="text" class="form-control" name="name" placeholder="First Name" required autofocus>

					<button class="btn btn-large btn-primary btn-block" type="submit">Submit</button>
				</form>
      		</div>
    	</div>
  	</div>
</div>

<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel">Register an Account</h4>
      		</div>
      		<div class="modal-body">
				<form class="form-signin" role="form" action="insert.php" method="post">
					<input class="form-control" type="email" name="email" placeholder="E-mail Address" required autofocus>
					<input class="form-control" type="text" name="firstname" placeholder="First Name" required>
					<input class="form-control" type="text" name="lastname" placeholder="Last Name" required>
					<input class="form-control" type="password" name="password" placeholder="Password" required>
					<input class="form-control" type="password" name="confirmpass" placeholder="Confirm Password" required>
					
					<button class="btn btn-large btn-primary btn-block" type="submit">Submit</button>
				</form>
      		</div>
    	</div>
  	</div>
</div>