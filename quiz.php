<?php
	session_start();
    	$path = './';
    	$page = 'Quiz';
    	require 'assets/inc/header.php';
    	require $path.'../../../dbConnect.inc';
?>

<?php
	//include "assets/php/login/login.php";

	if( !isset($_GET['quizid']) ){
		$quizid = $_POST['quiz'];
		
		$sql = 'SELECT userID FROM sbAccounts where username = "'.$_SESSION['uid'].'";';
		$result = $mysqli->query($sql);
		$rowHolder = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$userid = $rowHolder['userID'];

		$sql = 'SELECT count(*) as totalQs FROM sbQuizQuestions where quizid = ' . $quizid . ';';
		$result = $mysqli->query($sql);
		$rowHolder = mysqli_fetch_array($result, MYSQLI_ASSOC);

		unset($_POST['quiz']);
		$question_total = $rowHolder['totalQs'];
		if ($question_total > 3) {
			$question_total = 3;
		}
		$question_correct = 0;

		foreach ($_POST as $param_name => $param_val) {
			$val = 0;
			switch($param_val){
				case 'a':
					$val = 1;
					break;
				case 'b':
					$val = 2;
					break;
				case 'c':
					$val = 3;
					break;
				case 'd':
					$val = 4;
					break;
			}
			$sql = 'SELECT count(*) as total FROM sbQuizQuestions where id = '.$param_name.' AND answer='.$val.';';
			$result = $mysqli->query($sql);
			$rowHolder = mysqli_fetch_array($result, MYSQLI_ASSOC);

			if( $rowHolder['total'] >= 1 ){
				$question_correct+= 1;
			}
		}

		$stmt=$mysqli->prepare("INSERT INTO sbQuiz1Gradebook (UserID, quizid, points, totalpoints) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $userid, $quizid, $question_correct, $question_total);
		$stmt->execute();
		$stmt->close();
		
		header("Location: quizzes.php");
	}
?>
<body>
	<div id="right">
		<h2><span class="blue" class="bold">SQL</span><span class="light">Buddy</span></h2>
		<div class="content">
			<form method="POST" action="quiz.php">
				<input type='hidden' name='quiz' value='<?php echo $_GET['quizid']; ?>'/>
				<?php 
					// Select Data
					$quizid = $_GET['quizid'];
					$sql = 'SELECT id, quizid, question, a, b, c, d, answer FROM sbQuizQuestions where quizid = '.$quizid.' ORDER BY RAND() LIMIT 3;';
					$res=$mysqli->query($sql);

					// Display data
					if($res){
						while($rowHolder = mysqli_fetch_array($res, MYSQLI_ASSOC)){
							echo "<div class='question'>";
							echo "<span class='questionheader'>".$rowHolder["question"]."</span><br/>";
							echo "<div class='questionanswer'>";
								echo "<input type='radio' name='".$rowHolder["id"]."' value='a'> ".$rowHolder["a"]."<br>";
							echo "</div>";
							echo "<div class='questionanswer'>";
								echo "<input type='radio' name='".$rowHolder["id"]."' value='b'> ".$rowHolder["b"]."<br>";
							echo "</div>";
							echo "<div class='questionanswer'>";
								echo "<input type='radio' name='".$rowHolder["id"]."' value='c'> ".$rowHolder["c"]."<br>";
							echo "</div>";
							echo "<div class='questionanswer'>";
								echo "<input type='radio' name='".$rowHolder["id"]."' value='d'> ".$rowHolder["d"]."<br>";
							echo "</div>";
							echo "</div>";
						}
					}
					else{
						echo mysqli_error($mysqli);
						echo "Could not execute query";
					}
				?>
				<button type="submit">Submit</button>
			</form>
		</div>
	</div>
</body>
</html>