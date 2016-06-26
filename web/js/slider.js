$(function() {
	var ul = $(".slider ul");	// get the ul which contains the slides
	var slide_count = ul.children().length;		// determine the number of slides
	console.log("slide count upon initialization: " + slide_count);
	var slide_width_pc = 100.0 / slide_count;	// determine the width of each slide
	var slide_index = 0;		// create a reference for our current slide (within the array)
	var first_slide = ul.find("li:first-child");	// create a reference for the first slide
	var last_slide = ul.find("li:last-child");		// create a reference for the last slide
	var playing = false;

	/* 	We need to 'wrap' the current array of slides with the first and last ones in the array to
	 	allow us to create the illusion of looping the slides */
	
	// Clone the last slide and add as first li element
	last_slide.clone().prependTo(ul);

	// Clone the first slide and add as last li element
	first_slide.clone().appendTo(ul);

	ul.css("margin-left", "-100%");		// hide the first slide of the array, which is really the last slide due to the above trickery
	ul.css("width", slide_count * 100 + "%");	// set the width of the ul so that all slides fit

	// 'line up' the slides according to their index within the array
	ul.find("li").each(function(indx) {
		var left_percent = (slide_width_pc * indx) + "%";
		$(this).css({"left":left_percent});
		$(this).css({width:(100 / slide_count) + "%"});
	});

	
	// Listen for click of play button
	$(".slider .play").click(function() {
		//console.log("play button clicked, playing is set to " + playing);		// log a message to the console for debugging
		if(!playing) {
			slide(slide_index + 1);
			interval = setInterval(function(){
				slide(slide_index + 1)}, 4000);
			}
			playing = true;
			//slide(slide_index + 1);
	});
	
	// Listen for click of pause button
	$(".slider .pause").click(function() {
		//console.log("pause button clicked");
		if (playing) {
			clearInterval(interval);
			playing = false;
		}
	})

	function slide(new_slide_index) {
		var margin_left_pc = (new_slide_index * (-100) - 100) + "%";
		ul.animate({"margin-left": margin_left_pc}, 400, function() {
			// If new slide is before first slide
			if(new_slide_index < 0) {
				ul.css("margin-left", ((slide_count) * (-100)) + "%");
				new_slide_index = slide_count - 1;
			} 

			// If new slide is after last slide
			else if(new_slide_index >= slide_count) {
				ul.css("margin-left", "-100%");
				new_slide_index = 0;
			}

			slide_index = new_slide_index
		});

	}
});

function preserveGet($dest) {
		$url = window.location.href.split('?');
		window.location.href = $url[0] + $dest + '?' + $url[1];
}