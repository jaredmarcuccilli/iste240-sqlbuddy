<?php
	session_start();
    	$path = './';
    	$page = 'Lesson 4';
    	require 'assets/inc/header.php';
    	require $path.'../../../dbConnect.inc';
?>
		
<?php
	require $path.'../../../dbConnect.inc';
	$sql = "SELECT content FROM sbModularLessons where page='$page'";
	$result = $mysqli->query($sql);

	if($result->num_rows > 0){
		// Output the data for each row
		while ($row = $result->FETCH_ASSOC()) {
			echo $row['content'];
		}
	} else {
		echo "0 results!";
	}
?>

<?php 
	include "assets/js/sqlparser/sqlIncluder.php";
			loadLesson(1);
		?>
		<script>
			setup();
		</script>

		<?php
			require 'assets/inc/timestamp.php';
		?>
	</div>
</div>

<?php
    	require 'assets/inc/footer.php';
?>