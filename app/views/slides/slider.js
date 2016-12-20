/***********************/
/* slide functionality */
/***********************/
var slideIndex = 0;
showSlides();

function showSlides() {
    /* the duration variable is set by php before this script is called */
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > slides.length) slideIndex = 1;

    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, duration * 1000); // change slide at the specified interval
}

/*******************************************************/
/* hide the menu and cursor when the mouse is inactive */
/*******************************************************/
var interval = 1;
var nav = document.getElementsByClassName("navButtons");
var body = document.getElementsByTagName("body")[0];

setInterval(function() {
    //console.log("activity interval: " + interval + "s");
	if (interval >= 5) {
		for (var i = 0; i < nav.length; i++) {
            nav[i].style.top = "-4em";
		}

        body.style.cursor = "none";

	} else if (interval > 120) {
        interval = 6;
    }

	interval++;

}, 1000);

body.addEventListener("mousemove", function(e) {
	if(window.lastX !== e.clientX || window.lastY !== e.clientY){
    	for (var i = 0; i < nav.length; i++) {
			nav[i].style.top = "0";
		}

        if (body.style.cursor == "none") body.style.cursor = "inherit";

        interval = 1;
    }

    //console.log("Inactivity Interval reset with mousemove.");
    //console.log('window.lastX: ' + window.lastX + "   window.lastY: " + window.lastY);
    //console.log('e.clientX: ' + e.clientX+ "   e.clientY: " + e.clientY);
    window.lastX = e.clientX
    window.lastY = e.clientY
})
