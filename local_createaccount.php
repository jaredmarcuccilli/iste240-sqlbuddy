<?php
	session_start();
    	$path = './';
    	$page = 'Create Account';
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
	
	$usrname = test_input($_POST['registerUsername']);
	$pass = password_hash(test_input($_POST['registerPassword']), PASSWORD_DEFAULT);

	// Check if username is in use
	$stmt=$mysqli->prepare("SELECT userID FROM sbAccounts WHERE username=?");
	$stmt->bind_param("s", $usrname);
	$stmt->execute();
	$stmt->bind_result($res);
	$stmt->fetch();
	$stmt->close();

	if ($res != "") {
		// Username already in use
	} else {
		$stmt=$mysqli->prepare("INSERT INTO sbLogin (uname, pass) VALUES (?, ?)");
		$stmt->bind_param("ss", $usrname, $pass);
		$stmt->execute();
		$stmt->close();

		$stmt=$mysqli->prepare("INSERT INTO sbAccounts (username) VALUES (?)");
		$stmt->bind_param("s", $usrname);
		$stmt->execute();
		$stmt->close();

		$_SESSION['uid'] = $usrname;
		$_SESSION['loggedIn'] = true;
		header('Location: index.php');
	}
?>
