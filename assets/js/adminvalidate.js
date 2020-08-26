/* Validate Admin Panel Input (just the data, not with the database) - Jared Marcuccilli */

reSectionCode = /\d\d\d-\d\d/;
reNumber = /^\d+$/;

function courseCreateNewValidate() {
	sectionCode = document.getElementById("createNewCourseSECTION").value;
	instructorUserID = document.getElementById("createNewCourseINSTRUCTOR").value;
	if (reSectionCode.test(sectionCode) && sectionCode.length == 6) {
		console.log("Course: Create New - Section Code Valid");
		document.getElementById("createNewCourseSECTION").style.backgroundColor = "";
		aValid = true;
	} else {
		console.log("Course: Create New - Section Code Invalid");
		document.getElementById("createNewCourseSECTION").style.backgroundColor = "pink";
		aValid = false;
	}
	if (reNumber.test(instructorUserID)) {
		console.log("Course: Create New - Instructor User ID Valid");
		document.getElementById("createNewCourseINSTRUCTOR").style.backgroundColor = "";
		bValid = true;
	} else {
		console.log("Course: Create New - Instructor User ID Invalid");
		document.getElementById("createNewCourseINSTRUCTOR").style.backgroundColor = "pink";
		bValid = false;
	}
	return aValid && bValid;
}

function sectionAddStudentValidate() {
	sectionID = document.getElementById("addStudToCourseSECTIONID").value;
	studentUserID = document.getElementById("addStudToCourseSTUDENTID").value;
	if (reNumber.test(sectionID)) {
		console.log("Section: Add Student - Section ID Valid");
		document.getElementById("addStudToCourseSECTIONID").style.backgroundColor = "";
		aValid = true;
	} else {
		console.log("Section: Add Student - Section ID Invalid");
		document.getElementById("addStudToCourseSECTIONID").style.backgroundColor = "pink";
		aValid = false;
	}
	if (reNumber.test(studentUserID)) {
		console.log("Section: Add Student - Student User ID Valid");
		document.getElementById("addStudToCourseSTUDENTID").style.backgroundColor = "";
		bValid = true;
	} else {
		console.log("Section: Add Student - Student User ID Invalid");
		document.getElementById("addStudToCourseSTUDENTID").style.backgroundColor = "pink";
		bValid = false;
	}
	return aValid && bValid;
}

function sectionRemoveStudentValidate() {
	sectionID = document.getElementById("remStudFromCourseSECTIONID").value;
	studentUserID = document.getElementById("remStudFromCourseSTUDENTID").value;
	if (reNumber.test(sectionID)) {
		console.log("Section: Remove Student - Section ID Valid");
		document.getElementById("remStudFromCourseSECTIONID").style.backgroundColor = "";
		aValid = true;
	} else {
		console.log("Section: Remove Student - Section ID Invalid");
		document.getElementById("remStudFromCourseSECTIONID").style.backgroundColor = "pink";
		aValid = false;
	}
	if (reNumber.test(studentUserID)) {
		console.log("Section: Remove Student - Student User ID Valid");
		document.getElementById("remStudFromCourseSTUDENTID").style.backgroundColor = "";
		bValid = true;
	} else {
		console.log("Section: Remove Student - Student User ID Invalid");
		document.getElementById("remStudFromCourseSTUDENTID").style.backgroundColor = "pink";
		bValid = false;
	}
	return aValid && bValid; 
}

function sectionChangeInstructorValidate() {
	sectionID = document.getElementById("addInstToCourseSECTIONID").value;
	instructorUserID = document.getElementById("addInstToCourseINSTRUCTORID").value;
	if (reNumber.test(sectionID)) {
		console.log("Section: Change Instructor - Section ID Valid");
		document.getElementById("addInstToCourseSECTIONID").style.backgroundColor = "";
		aValid = true;
	} else {
		console.log("Section: Change Instructor - Section ID Invalid");
		document.getElementById("addInstToCourseSECTIONID").style.backgroundColor = "pink";
		aValid = false;
	}
	if (reNumber.test(instructorUserID)) {
		console.log("Section: Change Instructor - Instructor User ID Valid");
		document.getElementById("addInstToCourseINSTRUCTORID").style.backgroundColor = "";
		bValid = true;
	} else {
		console.log("Section: Change Instructor - Instructor User ID Invalid");
		document.getElementById("addInstToCourseINSTRUCTORID").style.backgroundColor = "pink";
		bValid = false;
	}
	return aValid && bValid;
}

function userChangeTypeValidate() {
	userID = document.getElementById("changeUsrTypeUSERID").value;
	if (reNumber.test(userID)) {
		console.log("User: Change Type - User ID Valid");
		document.getElementById("changeUsrTypeUSERID").style.backgroundColor = "";
		aValid = true;
	} else {
		console.log("User: Change Type - User ID Invalid");
		document.getElementById("changeUsrTypeUSERID").style.backgroundColor = "pink";
		aValid = false;
	}
	return aValid;
}

function courseDeleteValidate() {
	sectionID = document.getElementById("courseDeleteSECTIONID").value;
	if (reNumber.test(sectionID )) {
		console.log("Course: Delete - Section ID Valid");
		document.getElementById("courseDeleteSECTIONID").style.backgroundColor = "";
		aValid = true;
	} else {
		console.log("Course: Delete - Section ID Valid");
		document.getElementById("courseDeleteSECTIONID").style.backgroundColor = "pink";
		aValid = false;
	}
	return aValid;
}
