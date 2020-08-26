<?php
	session_start();
    	$path = './';
    	$page = 'Admin';
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
	foreach($_POST as $i => $current) {
		$_POST[$i] = test_input($current);
		echo "<script>console.log('Sanitized input: " . $current . "' );</script>";
	}
    	if ($mysqli) {
		// Course: Create new
		if (!empty($_POST['createNewCourseSECTION']) && !empty($_POST['createNewCourseINSTRUCTOR'])) {
			$stmt=$mysqli->prepare("INSERT INTO sbCourseSections (sectionName, instructorUserID) VALUES (?, ?)");
			$stmt->bind_param("ss", $createNewCourseSECTION, $createNewCourseINSTRUCTOR);
			$createNewCourseSECTION = $_POST['createNewCourseSECTION'];
			$createNewCourseINSTRUCTOR = $_POST['createNewCourseINSTRUCTOR'];
			$stmt->execute();
			$stmt->close();
		}
		// Course: Delete
		if (!empty($_POST['courseDeleteSECTIONID'])) {
			$stmt=$mysqli->prepare("DELETE FROM sbCourseSections WHERE sectionID = ?");
			$stmt->bind_param("s", $courseDeleteSECTIONID);
			$courseDeleteSECTIONID= $_POST['courseDeleteSECTIONID'];
			$stmt->execute();
			$stmt->close();
		}
		// Section: Add Student
		if (!empty($_POST['addStudToCourseSECTIONID']) && !empty($_POST['addStudToCourseSTUDENTID'])) {
			$stmt=$mysqli->prepare("INSERT INTO sbStudentSections (studUserID, studSectionID) VALUES (?, ?)");
			$stmt->bind_param("ss", $addStudToCourseSTUDENTID, $addStudToCourseSECTIONID);
			$addStudToCourseSTUDENTID= $_POST['addStudToCourseSTUDENTID'];
			$addStudToCourseSECTIONID= $_POST['addStudToCourseSECTIONID'];
			$stmt->execute();
			$stmt->close();
		}
		// Section: Remove Student
		if (!empty($_POST['remStudFromCourseSECTIONID']) && !empty($_POST['remStudFromCourseSTUDENTID'])) {
			$stmt=$mysqli->prepare("DELETE FROM sbStudentSections WHERE studUserID = ? AND studSectionID = ?");
			$stmt->bind_param("ss", $remStudFromCourseSTUDENTID, $remStudFromCourseSECTIONID);
			$remStudFromCourseSTUDENTID= $_POST['remStudFromCourseSTUDENTID'];
			$remStudFromCourseSECTIONID= $_POST['remStudFromCourseSECTIONID'];
			$stmt->execute();
			$stmt->close();
		}
		// Section: Change Instructor
		if (!empty($_POST['addInstToCourseSECTIONID']) && !empty($_POST['addInstToCourseINSTRUCTORID'])) {
			$stmt=$mysqli->prepare("UPDATE sbCourseSections SET instructorUserID = ? WHERE sectionID = ?");
			$stmt->bind_param("ss", $addInstToCourseINSTRUCTORID, $addInstToCourseSECTIONID);
			$addInstToCourseINSTRUCTORID= $_POST['addInstToCourseINSTRUCTORID'];
			$addInstToCourseSECTIONID= $_POST['addInstToCourseSECTIONID'];
			$stmt->execute();
			$stmt->close();
		}
		// User: Change Type
		if (!empty($_POST['changeUsrTypeUSERID'])) {
			$stmt=$mysqli->prepare("UPDATE sbAccounts SET type = ? WHERE userID = ?");
			$stmt->bind_param("ss", $changeUserTypeTYPE, $changeUsrTypeUSERID);
			$changeUserTypeTYPE= $_POST['changeUserTypeTYPE'];
			$changeUsrTypeUSERID= $_POST['changeUsrTypeUSERID'];
			$stmt->execute();
			$stmt->close();
		}
    	}
?>
	<div id="right">
		<div class="content">
			<?php
				$admin = false;
			if($loggedIn) {
				$sql = 'SELECT username FROM sbAccounts WHERE type="admin"';
				$res=$mysqli->query($sql);
				$recordsAdmins = [];
				if($res) {
					while($rowHolder = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
						$recordsAdmins[] = $rowHolder;
					}
				}
				foreach($recordsAdmins as $this_row) {
					if($this_row['username'] == $_SESSION['uid']) {
						$admin = true;
						echo "Welcome to the Admin Panel, ";
					} 
				}
				if (!$admin) {
					echo "You do not have access to the Admin Panel, ";
					
				}
				echo $_SESSION['uid'];
			}
			if(!$loggedIn) {
				?>
				Please log in to access the Admin Panel.
				<?php
			} else if ($admin) {
				?>
				<?php
				if ($mysqli) {
					$sql = 'SELECT userID, username, type FROM sbAccounts';
					$res=$mysqli->query($sql);
					
					if($res){
						while($rowHolder = mysqli_fetch_array($res, MYSQLI_ASSOC)){
							$recordsUsers[] = $rowHolder;
						}
					}

					$sql = 'SELECT sbCourseSections.sectionID, sbCourseSections.sectionName, sbCourseSections.instructorUserID, sbAccounts.username FROM sbCourseSections LEFT JOIN sbAccounts ON sbCourseSections.instructorUserID = sbAccounts.userID';
					$res=$mysqli->query($sql);
					
					if($res){
						while($rowHolder = mysqli_fetch_array($res, MYSQLI_ASSOC)){
							$recordsCourseSections[] = $rowHolder;
						}
					}

					$sql = 'SELECT sbStudentSections.studSectionID, sbCourseSections.sectionName, sbStudentSections.studUserID, sbAccounts.username FROM sbStudentSections INNER JOIN sbCourseSections ON sbStudentSections.studSectionID = sbCourseSections.sectionID INNER JOIN sbAccounts ON sbStudentSections.studUserID = sbAccounts.userID';
					$res=$mysqli->query($sql);
					
					if($res){
						while($rowHolder = mysqli_fetch_array($res, MYSQLI_ASSOC)){
							$recordsStudentSections[] = $rowHolder;
						}
					}

				}
				?>
					<h3>-- Admin Panel --</h3>
					<div style="margin-bottom: 20px">
					<h3>Users</h3>
					<table style="width:90%;">
						<tr>
							<th>User ID</th>
							<th>Username</th>
							<th>Type</th>
						</tr>
						<?php
							if (isset($recordsUsers)) {
								foreach($recordsUsers as $this_row) {
									echo '<tr><td>'.$this_row['userID'].'</td><td>'.$this_row['username'].'</td><td>'.$this_row['type'].'</td></tr>';
								}
							} else {
								#echo 'No results.';
							}
					?>
					</table>
					</div>
					<div style="margin-bottom: 20px">
					<h3>Course Sections</h3>
					<table style="width:90%;">
						<tr>
							<th>Section ID</th>
							<th>Section Code</th>
							<th>Instructor ID</th>
							<th>Instructor Username</th>
						</tr>
						<?php
							if (isset($recordsCourseSections)) {
								foreach($recordsCourseSections as $this_row) {
									echo '<tr><td>'.$this_row['sectionID'].'</td><td>'.$this_row['sectionName'].'</td><td>'.$this_row['instructorUserID'].'</td><td>'.$this_row['username'].'</td></tr>';
								}
							} else {
								#echo 'No results.';
							}
					?>
					</table>
					</div>
					<h3>Student Sections</h3>
					<table style="width:90%;"	>
						<tr>
							<th>Section ID</th>
							<th>Section Code</th>
							<th>Student ID</th>
							<th>Student Username</th>
						</tr>
						<?php
							if (isset($recordsStudentSections)) {
								foreach($recordsStudentSections as $this_row) {
									echo '<tr><td>'.$this_row['studSectionID'].'</td><td>'.$this_row['sectionName'].'</td><td>'.$this_row['studUserID'].'</td><td>'.$this_row['username'].'</td></tr>';
								}
							} else {
								#echo 'No results.';
							}
					?>
					</table>
					
					<h3>Modify</h3>
					<fieldset>
						<legend>Course: Create New</legend>
						<form action="admin.php" method="post" onsubmit="return courseCreateNewValidate()">
							Section Code<input type="text" id="createNewCourseSECTION" name="createNewCourseSECTION" placeholder="123-01"><br />
							Instructor User ID<input type="text" id="createNewCourseINSTRUCTOR" name="createNewCourseINSTRUCTOR" placeholder="1"><br />
							<div id="formButton">
								<input class="button" type="submit" value="Submit" />
							</div>
						</form>
					</fieldset>
					<fieldset>
						<legend>Section: Add Student</legend>
						<form action="admin.php" method="post" onsubmit="return sectionAddStudentValidate()">
							Section ID<input type="text" id="addStudToCourseSECTIONID" name="addStudToCourseSECTIONID" placeholder="1"><br />
							Student User ID<input type="text" id="addStudToCourseSTUDENTID" name="addStudToCourseSTUDENTID" placeholder="1"><br />
							<div id="formButton">
								<input class="button" type="submit" value="Submit" />
							</div>
						</form>
					</fieldset>
					<fieldset>
						<legend>Section: Remove Student</legend>
						<form action="admin.php" method="post" onsubmit="return sectionRemoveStudentValidate()">
							Section ID<input type="text" id="remStudFromCourseSECTIONID" name="remStudFromCourseSECTIONID" placeholder="1"><br />
							Student User ID<input type="text" id="remStudFromCourseSTUDENTID" name="remStudFromCourseSTUDENTID" placeholder="1"><br />
							<div id="formButton">
								<input class="button" type="submit" value="Submit" />
							</div>
						</form>
					</fieldset>
					<fieldset>
						<legend>Section: Change Instructor</legend>
						<form action="admin.php" method="post" onsubmit="return sectionChangeInstructorValidate()">
						Section ID<input type="text" id="addInstToCourseSECTIONID" name="addInstToCourseSECTIONID" placeholder="1"><br />
						Instructor User ID<input type="text" id="addInstToCourseINSTRUCTORID" name="addInstToCourseINSTRUCTORID" placeholder="1"><br />
							<div id="formButton">
								<input class="button" type="submit" value="Submit" />
							</div>
						</form>
					</fieldset>
					<fieldset>
						<legend>User: Change Type</legend>
						<form action="admin.php" method="post" onsubmit="return userChangeTypeValidate()">
							User ID<input type="text" id="changeUsrTypeUSERID" name="changeUsrTypeUSERID" placeholder="1">
							<select name="changeUserTypeTYPE">
								<option value="stud">stud</option>
								<option value="prof">prof</option>
								<option value="admin">admin</option>
							</select><br />
							<div id="formButton">
								<input class="button" type="submit" value="Submit" />
							</div>
						</form>
					</fieldset>
					<fieldset>
						<legend><span style="background-color: red;">Course: Delete</span></legend>
						<form action="admin.php" method="post" onsubmit="return courseDeleteValidate()">
							Section ID<input type="text" id="courseDeleteSECTIONID" name="courseDeleteSECTIONID" placeholder="1"><br />
							<div id="formButton">
								<input class="button" type="submit" value="Submit" />
							</div>
						</form>
					</fieldset>
				<?php
					require 'assets/inc/timestamp.php';
				?>
					<?php
				}
				?>
		</div>
	</div>
<?php
	require 'assets/inc/footer.php';
?>