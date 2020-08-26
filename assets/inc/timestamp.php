<div class="timestamp">
	<i>
	<?php
		$filename = basename($_SERVER['PHP_SELF']);
		date_default_timezone_set('America/New_York');
		if (file_exists($filename)) {
			echo "Last modified " . date ("F j, Y g:ia", filemtime($filename));
		}
	?>
	</i>
</div>