/**
 * ALL JAVASCRIPT LOCATED IN THIS FILE ONLY AFFECTS THE slider.php VIEW
 */

// slide functionality
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > slides.length) slideIndex = 1;
    slides[slideIndex - 1].style.display = "block"; 
    setTimeout(showSlides, 6000); // Change image every 6 seconds
}


// hide the menu and cursor when the mouse is inactive
var interval = 1;
var nav = document.getElementsByClassName("navButtons");
var body = document.getElementsByTagName("body")[0]
console.log(nav);

setInterval(function() {
	if (interval == 5) {
		for (var i = 0; i < nav.length; i++) {
			nav[i].style.top = "-10%";
		}

		body.style.cursor = "none";
	}

	interval = interval + 1;
}, 1000);

body.addEventListener("mousemove", function(e) {
	if(window.lastX !== e.clientX || window.lastY !== e.clientY){
    	for (var i = 0; i < nav.length; i++) {
			nav[i].style.top = "0";
		}

		body.style.cursor = "";
    }   
    window.lastX = e.clientX
    window.lastY = e.clientY

	interval = 1;
})
