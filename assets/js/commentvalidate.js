/* JavaScript Validation for Comments Form - Jared Marcuccilli */

// Check that name is not empty
function validateCommentName() {
	name = document.getElementById("nameComment").value;
	if (name === "") {
		document.getElementById("nameComment").style.backgroundColor = "pink";
		document.getElementById("nameValid").innerHTML = "Please enter a valid name";
		return false;
	} else {
		document.getElementById("nameComment").style.backgroundColor = "";
		document.getElementById("nameValid").innerHTML = "";
		return true;
	}
}

// Check that comment is not empty
function validateComment() {
	name = document.getElementById("comment").value;
	if (name === "") {
		document.getElementById("comment").style.backgroundColor = "pink";
		document.getElementById("commentValid").innerHTML = "Please enter a valid comment";
		return false;
	} else {
		document.getElementById("comment").style.backgroundColor = "";
		document.getElementById("commentValid").innerHTML = "";
		return true;
	}
}

// Validate customer name and ID
function validateCommentForm() {
	console.log("name ok " + validateCommentName());
	console.log("comment ok " + validateComment());
	return validateCommentName() && validateComment();
}
