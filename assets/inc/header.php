<!DOCTYPE html>

<?php
	if(isset($_SESSION['loggedIn'])) {
		$loggedIn = $_SESSION['loggedIn'];
	} else {
		$loggedIn = false;
	}
    	function addActive($linkname) {
        	$shortfilename = basename($_SERVER['PHP_SELF']);

        	if( $shortfilename == $linkname )
            	return "class=\"current\""; 
        	return "";
    	}
?>

<html lang="en">
<head>
	<title><?php echo $page ?></title>
	<meta charset="utf-8" />
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<link rel="stylesheet" href="assets/css/style.css" />
	<link rel="stylesheet" href="assets/css/sqltable.css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab:700&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="assets/media/favicon.ico">
	<script src="assets/js/adminvalidate.js"></script>
	<script src="assets/js/loginvalidate.js"></script>
	<script src="assets/js/commentvalidate.js"></script>
	<script src="assets/js/feedbackvalidate.js"></script>
	<script src="assets/js/QuizValidate.js"></script>
	<script src="assets/js/slideshowcontinous.js"></script>
</head>
<body>
	<div id="vertnav">
		<div id="MenuHeader"><span class='blue'>SQL</span><span class='light'>Buddy</span></div>
		<a href="index.php" id="HomeBtnV">Home</a>
		<a href="lessons.php" id="LessonsBtnV">Lessons</a>
		<a href="quizzes.php" id="QuizzesBtnV">Quizzes</a>
		<a href="gradebook.php" id="GradebookBtnV">Gradebook</a>
        	<a href="feedback.php" id="FeedbackBtnV">Feedback</a>
		<a href="register.php" id="LoginBtnV">Login</a>
		<a href="assets/php/login/logout.php">Logout</a>
		<a href="admin.php">Admin</a>
		<a href="references.php">References</a>

		<div id="copy"> <?php if(isset($_SESSION['givenName'])) { echo "Hello, ".$_SESSION['givenName']."!"; } ?> <?php if(isset($_SESSION['uid']) && !isset($_SESSION['givenName'])) { echo "Hello, ".$_SESSION['uid']."!"; } ?></div>
	</div>
	<div id="hornav">
        <a href="index.php" id="HomeBtnH">Home</a>
		<a href="lessons.php" id="LessonsBtnH">Lessons</a>
		<a href="quizzes.php" id="QuizzesBtnH">Quizzes</a>
		<a href="gradebook.php" id="GradebookBtnH">Gradebook</a>
        	<a href="feedback.php" id="FeedbackBtnH">Feedback</a>
		<a href="register.php" id="LoginBtnH">Login</a>
		<a href="assets/php/login/logout.php">Logout</a>
		<a href="references.php">References</a>
	</div>
    	<script>
        	thisPage = "<?php echo $page ?>";
        	thisPageBtnV = thisPage + "BtnV";
        	thisPageBtnH = thisPage + "BtnH";
        	document.getElementById(thisPageBtnV).classList.add("current");
        	document.getElementById(thisPageBtnH).classList.add("current");
    	</script>
