<?php
	$path = './';
	require $path.'../../../../../../dbConnect.inc';
	session_start();
	$_SESSION['givenName'] = $_POST['givenName'];
	$_SESSION['sn'] = $_POST['sn'];
	$_SESSION['uid'] = $_POST['uid'];
	$_SESSION['ritEduAffiliation'] = $_POST['ritEduAffiliation'];
	$_SESSION['ritEduMemberOfUid'] = $_POST['ritEduMemberOfUid'];
	$_SESSION['loggedIn'] = true;

	$sql = 'SELECT username FROM sbAccounts';
	$res=$mysqli->query($sql);
				
	if($res) {
		while($rowHolder = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
			$recordsExistingAccounts[] = $rowHolder;
		}
	}
	if(!in_array($_SESSION['uid'], $recordsExistingAccounts)) {
		echo "User not in database, adding...";
		$stmt=$mysqli->prepare("INSERT INTO sbAccounts (username) VALUES (?)");
		$stmt->bind_param("s", $_SESSION['uid']);
		$stmt->execute();
		$stmt->close();
	}

	header("Location: http://serenity.ist.rit.edu/~jrm9752/240/sqlbuddy/index.php");
?>