<?php
	session_start();
    	$path = './';
    	$page = 'Login';
    	require 'assets/inc/header.php';
    	require $path.'../../../dbConnect.inc';
?>
<div id="right">
	<div class="content">
		<h2><span class="blue bold">SQL</span><span class="light">Buddy</span></h2>
		<div class="centerRow"><h3>Welcome!</h3></div>
		<?php
			if(!$loggedIn) {
				?>
				<div class="centerRow"><h3>Create an Account</h3></div>
				<form action="register.php" method="post" onsubmit="return createAccountVerify()">
					<div class="centerRow"><input type="text" class="inputBoxStyled" id="registerUsername" name="registerUsername" placeholder="Username"></div>
					<div class="centerRow"><input type="password" class="inputBoxStyled" id="registerPassword" name="registerPassword" placeholder="Password"></div>
					<div class="centerRow"><input type="password" class="inputBoxStyled" id="registerPasswordVerify" name="registerPasswordVerify" placeholder="Verify Password"></div>
					<div class="centerRow"><i><div id="createNotify"></div></i></div>
					<div class="centerRow"><button type="submit" class="btnBlueLogin">Create Account</button></div>
				</form>

				<form action="register.php" method="post" onsubmit="return localLoginVerify()">
					<div class="centerRow"><h3>Local Login</h3></div>
					<div class="centerRow"><input type="text" class="inputBoxStyled" id="loginUsername" name="loginUsername" placeholder="Username"></div>
					<div class="centerRow"><input type="password" class="inputBoxStyled" id="loginPassword" name="loginPassword" placeholder="Password"></div>
					<div class="centerRow"><i><div id="loginNotify"></div></i></div>
					<div class="centerRow"><button type="submit" class="btnBlueLogin">Log In</button></div>
				</form>

				<div class="centerRow"><h3>RIT Account Single Sign-on</h3></div>
				<div class="centerRow"><button type="submit" onclick="location.href='assets/php/login/login.php';" class="btnRITLogin">Log In</button></div>
				<?php
			} else {
				?>
				<div class="centerRow">You are already logged in.</div>
				<?php
			}
		?>
		<?php
			require 'assets/inc/timestamp.php';
		?>
	</div>
</div>
<?php
	function test_input($data) {
      		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);

      		return $data;
    	}
	
	if (!empty($_POST['loginUsername']) && !empty($_POST['loginPassword'])) {
		$usrname = test_input($_POST['loginUsername']);
		$inputpass = test_input($_POST['loginPassword']);

		$stmt=$mysqli->prepare("SELECT pass FROM sbLogin WHERE uname=?");
		$stmt->bind_param("s", $usrname);
		$stmt->execute();
		$stmt->bind_result($res);
		$stmt->fetch();
		$stmt->close();
		
		if (password_verify($inputpass, $res)) {
			$_SESSION['uid'] = $usrname;
			$_SESSION['loggedIn'] = true;
			//header('Location: index.php');
			echo "<script>window.location.href = 'index.php'</script>";
		} else {
			// Incorrect login
			echo '<script type="text/JavaScript"> document.getElementById("loginNotify").innerHTML="Incorrect login."; </script>'; 
		}
	}

	if (!empty($_POST['registerUsername']) && !empty($_POST['registerPassword'])) {
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
			echo '<script type="text/JavaScript"> document.getElementById("createNotify").innerHTML="Username taken."; </script>';
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
			//header('Location: http://serenity.ist.rit.edu/~jrm9752/240/sqlbuddy/index.php');
			echo "<script>window.location.href = 'index.php'</script>";
		}
	}
?>

<?php
    	require 'assets/inc/footer.php';
?>