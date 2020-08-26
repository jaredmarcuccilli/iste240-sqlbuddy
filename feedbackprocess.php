<?php
	session_start();
    	$path = './';
    	$page = 'Feedback';
    	require 'assets/inc/header.php';
    	require $path.'../../../dbConnect.inc';
?>

<?php
	function test_input($data) {
      		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);

      		return $data;
    	}
	
	$visitor = test_input($_POST['visitor']);
	$position = test_input($_POST['position']);
	$use = ["None selected"];
	if (!empty($_POST['whyuse'])) {
		$use = $_POST['whyuse'];
	}
	$rating = test_input($_POST['rating']);
	$commentfield = test_input($_POST['commentfield']);
	
	// Checkboxes
	$uses = "";
	$N = count($use);

	if($N > 1) {
    		for($i=0; $i < ($N - 1); $i++) {
      			$uses = $uses . test_input($use[$i]) . ", ";
    		}
		$uses = $uses . test_input($use[$N - 1]);
	} else {
		$uses = test_input($use[0]);
	}

	$destemail = "jrm9752@g.rit.edu";
	$destemail2 = "RITISTprofessor@gmail.com";
	$emailsub = "2191 iSchool - SQLBuddy Feedback - Group 1";

	$emailbody = "Visitor name: $visitor\n";
	$emailbody .= "Position: $position \n";
	$emailbody .= "Uses: $uses \n";
	$emailbody .= "Rating: $rating\n";
	$emailbody .= "Additional comments: $commentfield\n";
	$emailbody .= "Submitted on " . date('m/d/Y h:i:s a', time());

	mail($destemail, $emailsub, $emailbody);
	mail($destemail2, $emailsub, $emailbody);

	$stmt=$mysqli->prepare("INSERT INTO sbFeedback (name, position, uses, rating, comment) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("sssss", $visitor, $position, $uses, $rating, $commentfield);
	$stmt->execute();
	$stmt->close();
?>

<div id="right">
	<div class="content">
		<h2><span class="blue" class="bold">SQL</span><span class="light">Buddy</span></h2>
		<div class="centerRow"><h3>Thank you for your feedback!</h3></div>
		<div class="centerRow"><img src="assets/media/thankyou.png" alt="Thank You" title="Thank You" /></div>
		<br />
		<div class="centerRow"><i><?php
			echo "Feedback submitted on " . date('m/d/Y h:i:s a', time());
		?></i></div>
		<?php
			require 'assets/inc/timestamp.php';
		?>
	</div>
</div>

<?php
    	require 'assets/inc/footer.php';
?>