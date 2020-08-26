<?php
	session_start();
    	$path = './';
    	$page = 'Gradebook';
    	require 'assets/inc/header.php';
    	require $path.'../../../dbConnect.inc';
?>

<div id="right">
	<div class="content">
		<h3>Gradebook</h3>
		<?php
			$prof = false;
			if($loggedIn) {
				$sql = 'SELECT username FROM sbAccounts WHERE type="prof"';
				$res=$mysqli->query($sql);
				
				if($res) {
					while($rowHolder = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
						$recordsProf[] = $rowHolder;
					}
				}
				foreach($recordsProf as $this_row) {
					if($this_row['username'] == $_SESSION['uid']) {
						$prof = true;
					} 
				}
			}

			if(!$loggedIn) {
				echo "Please log in to access your Gradebook.";
			} else {
				echo "Welcome to your Gradebook, " . $_SESSION['uid'] . "! ";
				if($prof) {
					echo "You are an Instructor.";
					$sql = 'SELECT sbAccounts.username, quizid, sbQuiz1Gradebook.points, sbQuiz1Gradebook.totalpoints, sbQuiz1Gradebook.timestamp FROM sbQuiz1Gradebook INNER JOIN sbAccounts ON sbAccounts.userID = sbQuiz1Gradebook.userID ORDER BY username, quizid, timestamp ASC';
					$res=$mysqli->query($sql);
					
					if($res){
						while($rowHolder = mysqli_fetch_array($res, MYSQLI_ASSOC)){
							$recordsGrades[] = $rowHolder;
						}
					}

					$sql = 'SELECT sbCourseSections.sectionID, sbCourseSections.sectionName FROM sbCourseSections LEFT JOIN sbAccounts ON sbCourseSections.instructorUserID = sbAccounts.userID WHERE sbAccounts.username = "' . $_SESSION['uid'] . '"';
					#echo $sql;
					$res=$mysqli->query($sql);
					
					if($res){
						while($rowHolder = mysqli_fetch_array($res, MYSQLI_ASSOC)){
							$recordsCourseSections[] = $rowHolder;
						}
					}

					?>
					<table style="width: auto;">
					<tr>
						<th>Username</th>
						<th>Quiz ID</th>
						<th>Points Earned</th>
						<th>Out Of</th>
						<th>Grade</th>
						<th>Timestamp</th>
					</tr>
					<?php
						if (isset($recordsGrades)) {
							foreach($recordsGrades as $this_row) {
								$avg = round($this_row['points'] / $this_row['totalpoints'], 2) * 100;
								echo '<tr><td>'.$this_row['username'].'</td><td>'.$this_row['quizid'].'</td><td>'.$this_row['points'].'</td><td>'.$this_row['totalpoints'].'</td><td>'.$avg.'%</td><td>'.$this_row['timestamp'].'</td></tr>';
							}
						} else {
							#echo 'No results.';
						}
					?>
					</table>
					<h3>My Course Sections</h3>
					<table style="width: auto%;">
						<tr>
							<th>Section ID</th>
							<th>Section Code</th>
						</tr>
						<?php
							if (isset($recordsCourseSections)) {
								foreach($recordsCourseSections as $this_row) {
									echo '<tr><td>'.$this_row['sectionID'].'</td><td>'.$this_row['sectionName'].'</td></tr>';
								}
							} else {
								#echo 'No results.';
							}
					?>
					</table>	
				<?php
				} else {
					echo "You are a Student.";
					$sql = 'SELECT quizid, points, totalpoints, timestamp FROM sbQuiz1Gradebook WHERE userID LIKE (SELECT userID FROM sbAccounts WHERE username = "' . $_SESSION['uid'] . '") ORDER BY quizid, timestamp ASC';
					#echo $sql;
					$res=$mysqli->query($sql);
					
					if($res){
						while($rowHolder = mysqli_fetch_array($res, MYSQLI_ASSOC)){
							$studentGrades[] = $rowHolder;
						}
					}
					?>
					<table style="width: auto;">
					<tr>
						<th>Quiz ID</th>
						<th>Points Earned</th>
						<th>Out Of</th>
						<th>Grade</th>
						<th>Timestamp</th>
					</tr>
					<?php
						if (isset($studentGrades)) {
							foreach($studentGrades as $this_row) {
								$avg = round($this_row['points'] / $this_row['totalpoints'], 2) * 100;
								echo '<tr><td>'.$this_row['quizid'].'</td><td>'.$this_row['points'].'</td><td>'.$this_row['totalpoints'].'</td><td align="right">'.$avg.'%</td><td>'.$this_row['timestamp'].'</td></tr>';
							}
						} else {
							#echo 'No results.';
						}
					?>

				</table>
				<?php
				}
			}
		?>
		<?php
			require 'assets/inc/timestamp.php';
		?>
	</div>
</div>

<?php
    	require 'assets/inc/footer.php';
?>