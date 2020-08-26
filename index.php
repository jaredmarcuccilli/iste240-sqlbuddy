<?php
	session_start();
    	$path = './';
    	$page = 'Home';
    	require 'assets/inc/header.php';
    	require $path.'../../../dbConnect.inc';
?>

<div id="right">
	<div class="content">
		<h2><span class="blue bold">SQL</span><span class="light">Buddy</span></h2>
		<div class="centerRow"><h3>Welcome to SQLBuddy!</h3></div>
		<div id="pic">
		<img id="slideshow" src="assets/slideshow/main0.png" style="width: 75%;" class="slideshowCenter border" alt="SQLBuddy Slideshow" title="SQLBuddy Slideshow">
		</div>
		<p>
		To use SQLBuddy, please click "Login" to Register, Log In, or log in with your RIT account.
		</p>
		<p>
		Now for step 2! Go to your lessons and begin working on the provided lessons that your instructor has given you. 
		</p>
		<p>
		Once you finished some lessons move on to your quizzes and get those A+ scores!
		</p>
		<p>
		When all is said and done, go to your Gradebook and see to it that your scores are reflecting the excellent work you have done!
		</p>
		<?php
			require 'assets/inc/timestamp.php';
		?>
	</div>
</div>

<?php
    	require 'assets/inc/footer.php';
?>