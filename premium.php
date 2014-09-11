<?php session_start() ?>

<!DOCTYPE html>

<html>

	<?php
	include "includes/mainhead.html";
	include "includes/dbconnect.php";
	include "includes/functions.php";
	?>

	<body>

		<?php
		$membership = getMembership($_SESSION['id']);

		if(strlen($membership) > 0){
			if($membership==0){
				if($stmt=$mysqli->prepare("UPDATE test SET membership=2 WHERE id=?")){
					$stmt->bind_param("d", $_SESSION['id']);
					$stmt->execute();
					$stmt->close();
				}
				echo "Your membership has been updated <br>";
			}

			else{
				echo "You already have a membership<br>";
			}
		}

		else{
			echo "You need to be logged in in order to sign up for a membership, if you do not have an account, you can regiser <a href='regiset.html'>here.</a>";
		}
		?>

	</body>
</html>