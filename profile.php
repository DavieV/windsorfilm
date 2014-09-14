<?php
//A dynamic profile page which displays information based on the id in the URL
//used to display the profile's of users found using the search feature
session_start();
?>

<!DOCTYPE html>

<html>
	
	<?php include "includes/mainhead.html"; ?>

	<body>

		<?php
		//Navigavtion Bar
		include "includes/functions.php";
		include "includes/navbar.php";
		$info = getInfo($_GET['id']); //use the id in the URL rather than a session variable
		$talents = getTalents($_GET['id']);
		/*
		Info Reference:
		firstname = 0
		lastname = 1
		phone = 2
		businessphone = 3
		email = 4
		image = 5
		video = 6
		bio = 7
		*/
		?>

		<div class="jumbotron">
			<div class="container">
				<?php
				if(isset($info[5])){
					echo "<img src='" . $info[5] . "' height='80%' width='15%' class='float-left'>";
				}
				?>
				<h1>
					<?php
					echo $info[0] . " " . $info[1];
					?>
				</h1>
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
							<li class="list-group-item"><span class="glyphicon glyphicon-envelope"></span><?php echo " Email Address:<br>" . $info[4]; ?></li>
							<li class="list-group-item"><span class="glyphicon glyphicon-earphone"></span><?php echo " Phone Number:<br>" . $info[2]; ?></li>
							<li class="list-group-item"><span class="glyphicon glyphicon-phone-alt"></span>
							<?php
							if(isset($info[3])){
								echo " Business Number:<br>" . $info[3];
							}
							?>
							</li>
						</ul>
						<div class="panel-heading">
							<h3 class="panel-title">Talent Areas</h3>
						</div>
						<ul class="list-group">
							<?php
							for($i = 0; $i < 7; $i++){
								if(isset($talents[$i])){
									echo "<li class='list-group-item'>" . $talents[$i] . "</li>";
								}
							}
							?>
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
								<?php
								if(strlen($info[7]) > 0){
									echo $info[7];
								}
								else{
									echo "This person has not yet written a bio.";
								}
								?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-10 col-md-offset-1">
					<?php
						if(strlen($info[6]) > 0){
							echo "<div class='embed-responsive embed-responsive-16by9'>"; 
							echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe class='embed-responsive-item' src=\"//www.youtube.com/embed/$1\"></iframe>", $info[6]);
							echo "</div>";
						}
					?>
				</div>
			</div>
		</div>

	</body>
</html>