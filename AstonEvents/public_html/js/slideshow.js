//Script for simple home page slideshow

//Variables
var i = 0;
var images = [];
var time = 3000;

//Image List
images[0] = 'css/images/home1.jpg';
images[1] = 'css/images/home2.jpg';
images[2] = 'css/images/home3.jpg';
images[3] = 'css/images/home4.jpg';
images[4] = 'css/images/home5.jpg';

//Change image function
function changeImage() {
    document.slides.src = images[i];

    if (i < images.length - 1) {
        i++
    } else {
        i = 0;
    }

    //Interval
    setTimeout("changeImage()", time)
}

//Run function when home page loads
window.onload = changeImage;