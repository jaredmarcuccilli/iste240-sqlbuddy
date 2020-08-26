// Jared Marcuccilli 2019
// Modified from Prof. Habermas

//Create an array of images 
var imageArray = ["assets/slideshow/main0.png", "assets/slideshow/main1.png", "assets/slideshow/main2.png"];

//Save total size of array to variable arraySize
var arraySize = imageArray.length;

//Set wait time between slides in milliseconds 
setInterval(runit, 3000);

var x = 0; //Used to count up to arraySize

//Function runit play slideshow when called 
function runit() {
    //Set image to next picture in image array
    if (document.getElementById('slideshow') != null) {
        document.getElementById('slideshow').src = imageArray[x];
    }

    //Increase count by 1
    x++;

    //If count has reached the last index of imageArray than set count back to starting index.
    if (x === arraySize) {
        x = 0;
    }
}

