<?php
	session_start();
    	$path = './';
    	$page = 'Feedback';
    	require 'assets/inc/header.php';
    	require $path.'../../../dbConnect.inc';
?>

<?php
	// sanitize input
    	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
    	if ($mysqli) {
		if (!empty($_POST['nameComment']) && !empty($_POST['comment'])) {
			if( $_POST['nameComment']!='' && $_POST['comment']!='' ){
				$stmt=$mysqli->prepare("INSERT INTO sbComments (name, comment) VALUES (?, ?)");
				$stmt->bind_param("ss", $nameComment, $comment);
				$nameComment = test_input($_POST['nameComment']);
				$comment = test_input($_POST['comment']);
				$stmt->execute();
				$stmt->close();
			}
		}
		$sql = 'SELECT name, date, comment FROM sbComments';
		$res=$mysqli->query($sql);
		if($res){
			while($rowHolder = mysqli_fetch_array($res,MYSQLI_ASSOC)){
				$records[] = $rowHolder;
			}
		}
    	}
?>
<style>
	input[type="text"] {
		padding: 1em;
		margin: 1em;
		width: 80%;
	}
	input[type="submit"] {
		margin: 1em;
		width: 10em;
		height: 2em;
	}
	table {
		border-collapse: collapse;
		width: 100%;
	}
	th {
		background-color: #3A73B8;
		color: #FFF;
	}
	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}
	tr:nth-child(even) {
		background-color: #DDD;
	}

	@media only screen and (max-width: 768px) {
		input[type="text"] {
			#width: 100%;
			padding: 1em;
			margin: 0 auto;
			display: block;
		}
		input[type="submit"] {
			width: 60%;
			height: 3em;
			margin: 1em auto;
			display: block;
		}
	}
</style>

<div id="right">
	<div class="content">
        <h3>We'd love to hear your feedback!</h3>
		<form action="feedbackprocess.php" method = "POST" onsubmit="return validateFeedbackForm();">

			<div id="name"><!-- Name -->
				Your name:<span class="astx"> * </span>
				<br />
				<input type="text" id="visitor" name="visitor" placeholder="" />
				<br />
				<i><div id="visitorValid"></div></i>
			</div>

			<fieldset><!-- Position -->
				<legend>What is your position?<span class="astx"> * </span></legend>

				<input type="radio" name="position" value="College Student" id="positionRadioCollegeStudent" />
				<label for="positionRadioCollegeStudent">College Student</label>
				<br />

				<input type="radio" name="position" value="Professor" id="positionRadioProfessor" />
				<label for="positionRadioProfessor">College Professor</label>
				<br />

				<input type="radio" name="position" value="K12 Student" id="positionRadioK12Student" />
				<label for="positionRadioK12Student">K12 Student</label>
				<br />

                		<input type="radio" name="position" value="K12 Teacher" id="positionRadioK12Teacher" />
				<label for="positionRadioK12Teacher">K12 Teacher</label>
				<br />

                		<input type="radio" name="position" value="Personal Education" id="positionRadioPersonal" />
				<label for="positionRadioPersonal">Personal Education</label>
				<br />
				<i><div id="positionValid"></div></i>

			</fieldset>
			<br />
			<fieldset>
				<legend>What do you use SQLBuddy for?</legend>

				<input type="checkbox" name="whyuse[]" value="Use in class" id="whyCheckUseInClass">
				<label for="whyCheckUseInClass">Use in class</label>
				<br />

				<input type="checkbox" name="whyuse[]" value="Use outside of class" id="whyCheckUseOutsideClass">
				<label for="whyCheckUseOutsideClass">Use outside of class</label>
				<br />

				<input type="checkbox" name="whyuse[]" value="Personal Education" id="whyCheckPersonalUse">
				<label for="whyCheckPersonalUse">Personal Education</label>
				<br />

			</fieldset>
			<br />
			<fieldset>
				<legend>Please rate your experience with SQLBuddy:</legend>
			<div class="slidecontainer"><!-- Rating slider -->
				<br />
				0
				<input type="range" name="rating" min="0" max="10" step="1" list="set">
				<datalist id = "set">
				<option>0</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
				<option>7</option>
				<option>8</option>
				<option>9</option>
				<option>10</option>
				</datalist>
				10
			</div>
			</fieldset>

			<div id="commentfield">
				<br />
				Additional comments:
				<br />
				<br />
				<textarea name="commentfield" rows="5" cols="60"></textarea>
			</div>

			<div id="button">
				<input type = "submit">
			</div>

		</form>
		<h3>Leave a Comment!</h3>
		<form action="feedback.php" method="post" onsubmit="return validateCommentForm()">
			<input type="text" id="nameComment" name="nameComment" placeholder="Name"><br />
			<i><div id="nameValid"></div></i>
			<input type="text" id="comment" name="comment" placeholder="Comment">
			<i><div id="commentValid"></div></i>
			<div id="formButton">
				<input class="button" type="submit" value="Comment" />
			</div>
		</form>
		<h3>Comments</h3>
			<table>
				<tr>
					<th>Name</th>
					<th>Date</th>
					<th>Comment</th>
				</tr>
				<?php
					foreach($records as $this_row) {
						echo '<tr><td>'.$this_row['name'].'</td><td>'.$this_row['date'].'</td><td>'.$this_row['comment'].'</td></tr>';
					}
				?>
			</table>
		<?php
			require 'assets/inc/timestamp.php';
		?>
	</div>
</div>

<?php
	require 'assets/inc/footer.php';
?>
