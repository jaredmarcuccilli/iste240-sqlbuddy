reNumber = /^\d+$/;

function validateAddQuizID() {
	addQuizID = document.getElementById("addQuizQuizID").value;
	if (!reNumber.test(addQuizID)) {
		document.getElementById("addQuizQuizID").style.backgroundColor = "pink";
		return false;
	} else {
		document.getElementById("addQuizQuizID").style.backgroundColor = "";
		return true;
	}
}

function validateAddQuizQuestion() {
	addQuizQuestion = document.getElementById("addQuizQuestion").value;
	if (addQuizQuestion === "") {
		document.getElementById("addQuizQuestion").style.backgroundColor = "pink";
		return false;
	} else {
		document.getElementById("addQuizQuestion").style.backgroundColor = "";
		return true;
	}
}


function validateAddQuizA() {
	addQuizA = document.getElementById("addQuizAnswerA").value;
	if (addQuizA === "") {
		document.getElementById("addQuizAnswerA").style.backgroundColor = "pink";
		return false;
	} else {
		document.getElementById("addQuizAnswerA").style.backgroundColor = "";
		return true;
	}
}

function validateAddQuizB() {
	addQuizB = document.getElementById("addQuizAnswerB").value;
	if (addQuizB === "") {
		document.getElementById("addQuizAnswerB").style.backgroundColor = "pink";
		return false;
	} else {
		document.getElementById("addQuizAnswerB").style.backgroundColor = "";
		return true;
	}
}

function validateAddQuizC() {
	addQuizC = document.getElementById("addQuizAnswerC").value;
	if (addQuizC === "") {
		document.getElementById("addQuizAnswerC").style.backgroundColor = "pink";
		return false;
	} else {
		document.getElementById("addQuizAnswerC").style.backgroundColor = "";
		return true;
	}
}

function validateAddQuizD() {
	addQuizD = document.getElementById("addQuizAnswerD").value;
	if (addQuizD === "") {
		document.getElementById("addQuizAnswerD").style.backgroundColor = "pink";
		return false;
	} else {
		document.getElementById("addQuizAnswerD").style.backgroundColor = "";
		return true;
	}
}

function validateAddQuizCorrect() {
	addQuizCorrect = document.getElementById("addQuizCorrectAnswer").value;
	if (!reNumber.test(addQuizCorrect )) {
		document.getElementById("addQuizCorrectAnswer").style.backgroundColor = "pink";
		return false;
	} else {
		document.getElementById("addQuizCorrectAnswer").style.backgroundColor = "";
		return true;
	}
}

function quizAddValidate() {
	return validateAddQuizID() && validateAddQuizQuestion() && validateAddQuizA() && validateAddQuizB() && validateAddQuizC() && validateAddQuizD() && validateAddQuizCorrect();
}



