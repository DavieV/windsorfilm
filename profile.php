<?php

include "includes/functions.php";

$currentUser=new User($_GET['id']);

include "includes/userinfo.php";

?>