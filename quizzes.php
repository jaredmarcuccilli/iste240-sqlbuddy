<?php
	session_start();
    	$path = './';
    	$page = 'Quizzes';
    	require 'assets/inc/header.php';
    	require $path.'../../../dbConnect.inc';	
	
	if( isset($_SESSION['uid']) ) {
		$sql = 'SELECT userID FROM sbAccounts WHERE username = "'.$_SESSION['uid'].'";';
		$res=$mysqli->query($sql);
		$rowHolder = mysqli_fetch_array($res, MYSQLI_ASSOC);
		$userid = $rowHolder['userID'];
	}
?>

<?php
	function test_input($data) {
		$data = trim($data);
	    	$data = stripslashes($data);
	    	$data = htmlspecialchars($data);
	    	return $data;
	}
	foreach($_POST as $i => $current) {
		$_POST[$i] = test_input($current);
		echo "<script>console.log('Sanitized input: " . $current . "' );</script>";
	}
    	if ($mysqli) {
		// Quiz: Create Quiz & Question
		if (!empty($_POST['addQuizQuizID']) && !empty($_POST['addQuizQuestion']) && !empty($_POST['addQuizAnswerA']) && !empty($_POST['addQuizAnswerB']) && !empty($_POST['addQuizAnswerC']) && !empty($_POST['addQuizAnswerD']) && !empty($_POST['addQuizCorrectAnswer'])) {
			$stmt=$mysqli->prepare("INSERT INTO sbQuizQuestions (quizid, question, a, b, c, d, answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssssss", $_POST['addQuizQuizID'], $_POST['addQuizQuestion'], $_POST['addQuizAnswerA'], $_POST['addQuizAnswerB'], $_POST['addQuizAnswerC'], $_POST['addQuizAnswerD'], $_POST['addQuizCorrectAnswer']);
			$stmt->execute();
			$stmt->close();
		}
    	}
?>

<div id="right">
	<div class="content">
		<h2><span class="blue bold">SQL</span><span class="light">Buddy</span></h2>
		<h3>Quizzes</h3>
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
				echo "Please log in to access Quizzes.";
			} else {
			?>
				<div id=LessonInterpreter>
		
		<table class='sqlTable'>
			<tr>
				<th>Quiz</th>
				<th>Previous Attempt</th>
				<th>Take Quiz</th>
			</tr>
				<?php
					// Select Data
					$sql = 'SELECT * FROM sbQuizQuestions GROUP BY quizid;';
					$res=$mysqli->query($sql);


					// Display data
					if($res){
						while($rowHolder = mysqli_fetch_array($res, MYSQLI_ASSOC)){

							$sql = 'SELECT points, totalpoints FROM sbQuiz1Gradebook WHERE quizid = '.$rowHolder['quizid'].' AND userid = '.$userid.' ORDER BY ID DESC LIMIT 1;';
							$res2=$mysqli->query($sql);
							$recentRowHolder = mysqli_fetch_array($res2, MYSQLI_ASSOC);
							
							echo "<tr>";
							echo "<td>Quiz ".$rowHolder['quizid']."</td>";
							if($recentRowHolder)
								echo "<td>".$recentRowHolder['points']."/".$recentRowHolder['totalpoints']."</td>";
							else
								echo "<td>N/A</td>";
							echo "<td><a href='quiz?quizid=".$rowHolder['quizid']."'>Take Quiz!</a></td>";
							echo "</tr>";
						}
					}
					else{
						echo mysqli_error($mysqli);
					}
				?>
			</table>

		</div>
			<?php

			}
		?>
		<?php
		if ($prof) {
		?>
		<fieldset>
			<legend><span>Quiz: Add Question</span></legend>
				<form action="quizzes.php" method="post" onsubmit="return quizAddValidate()">
					QuizID<input type="text" id="addQuizQuizID" name="addQuizQuizID" placeholder="1"><br />
					Question<input type="text" id="addQuizQuestion" name="addQuizQuestion" placeholder="What is the meaning of life?"><br />
					A<input type="text" id="addQuizAnswerA" name="addQuizAnswerA" placeholder="Nothing"><br />
					B<input type="text" id="addQuizAnswerB" name="addQuizAnswerB" placeholder="PHP"><br />
					C<input type="text" id="addQuizAnswerC" name="addQuizAnswerC" placeholder="SQL"><br />
					D<input type="text" id="addQuizAnswerD" name="addQuizAnswerD" placeholder="Suffering"><br />
					Correct Answer<input type="text" id="addQuizCorrectAnswer" name="addQuizCorrectAnswer" placeholder="1"><br />

					<div id="formButton">
						<input class="button" type="submit" value="Submit" />
					</div>
				</form>
		</fieldset>
		<?php
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