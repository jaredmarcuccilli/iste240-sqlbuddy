/* JavaScript Validation for Local DB Login & Account Creation - Jared Marcuccilli */

alphanum = /^[0-9a-zA-Z]+$/;
function validateOnlyLetters(elem) {
	val = elem.value;
	if (!alphanum.test(val)) {
		elem.style.backgroundColor = "pink";
		console.log(val);
		console.log("invalid");
		return false;
	} else {
		elem.style.backgroundColor = "";
		console.log("valid");
		return true;
	}
}

function validateSame(x, y) {
	val1 = x.value;
	val2 = y.value;
	if (val1 == val2) {
		console.log("same");
		x.style.backgroundColor = "";
		y.style.backgroundColor = "";
		return true;
	} else {
		console.log("not the same");	
		x.style.backgroundColor = "pink";
		y.style.backgroundColor = "pink";
		return false;
	}
}

function createAccountVerify() {
	validateSame(document.getElementById("registerPassword"), document.getElementById("registerPasswordVerify"));
	validateOnlyLetters(document.getElementById("registerUsername"));
	validateOnlyLetters(document.getElementById("registerPassword"));
	validateOnlyLetters(document.getElementById("registerPasswordVerify"));

	return validateSame(document.getElementById("registerPassword"), document.getElementById("registerPasswordVerify"))
	&& validateOnlyLetters(document.getElementById("registerUsername")) 
	&& validateOnlyLetters(document.getElementById("registerPassword")) 
	&& validateOnlyLetters(document.getElementById("registerPasswordVerify"));
}

function localLoginVerify() {
	validateOnlyLetters(document.getElementById("loginUsername"));
	validateOnlyLetters(document.getElementById("loginPassword"));

	return validateOnlyLetters(document.getElementById("loginUsername"))
	&& validateOnlyLetters(document.getElementById("loginUsername"));
}