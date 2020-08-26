/* JavaScript Validation for Feedback Form - Jared Marcuccilli */

// Check that name is not empty
function validateName() {
	name = document.getElementById("visitor").value;
	if (name === "") {
		document.getElementById("visitor").style.backgroundColor = "pink";
		document.getElementById("visitorValid").innerHTML = "Please enter a name";
		return false;
	} else {
		document.getElementById("visitor").style.backgroundColor = "";
		document.getElementById("visitorValid").innerHTML = "";
		return true;
	}
}

// Check that a position is selected
function validatePosition() {
	"use strict";
    	var isChecked = false;
	var len = document.getElementsByName('position').length;
	var choices = new Array();
	for (var i=0; i<len; i++) {
		if (document.getElementsByName('position')[i].checked) {
			choices.push(document.getElementsByName('position')[i].value);
		}
	}

    	if (choices.length > 0) {
        	isChecked = true;
        	document.getElementsByTagName('fieldset')[0].style = null;
        	//document.getElementsByTagName('legend')[0].style= null;
    	} else {
        	document.getElementsByTagName('fieldset')[0].style.borderColor = 'red';
        	//document.getElementsByTagName('legend')[0].style.color = 'red';
		document.getElementById("positionValid").innerHTML = "Please select a position";
    	}
    	return isChecked;
}

// Validate feedback form
function validateFeedbackForm() {
	console.log("name ok " + validateName());
	console.log("position ok " + validatePosition());
	return validateName() && validatePosition();
}