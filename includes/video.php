<div class="col-md-12 col-xl-8 col-xl-offset-2">
	<div class="embed-responsive embed-responsive-16by9">
		<?php
		echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe class='embed-responsive-item' src=\"//www.youtube.com/embed/$1\"></iframe>", $info[6]);
		?>
	</div>
</div>