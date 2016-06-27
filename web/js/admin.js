function goHome() {
	window.location.href = location.href.replace('admin.php', '');
}


function toggleLightBox(id) {
	if (id === undefined) {
		id = 'lightbox';
	}
	
	lightbox = document.getElementById('lightbox');
	lightbox.style.display == 'none' || lightbox.style.display == '' ? lightbox.style.display = 'initial' : lightbox.style.display = 'none';

	return lightbox;
}

// THIS FUNCTION ALLOWS USERS TO ADD A SLIDE TO THE SYSTEM
function add_slide() {
	lightbox = toggleLightBox().getElementsByClassName('lb_container')[0];
	
	$add_slide_form = 	'<h1>Add a Slide</h1>' +
						'<form action="<?php echo $_SERVER[\'PHP_SELF\'];?>" method="post">' +
						'<input type="hidden" name="url_submitted" value="true">' +
						'<input type="url" value="URL">' +
						'<input type="submit" value="Download">' +
						'</form>' +
						'<form action="<?php echo $_SERVER[\'PHP_SELF\'];?>" method="post" enctype="multiport/form-data">' +
						'<input type="hidden" name="file_submitted" value="true">' +
						'<input type="file" value="upload">' +
						'<input type="submit" value="Upload">' +
						'</form>';
	console.log(lightbox);
	lightbox.innerHTML = $add_slide_form;
	
}


// THIS FUNCTION ALLOWS USERS TO EDIT THE PARAMETERS OF A SLIDE
function edit() {
	toggleLightBox();
}


// THIS FUNCTION REMOVES A SLIDE (AND ITS ASSOCIATED PARAMETERS) FROM THE SYSTEM
function del() {
	
}


/**
 * cancels out javascript event handler bubbling
 * @param e - the triggering event (i.e. onclick="childHandler(event);")
 */
function childHandler(e) {
    if (!e) var e = window.event;
    e.cancelBubble = true;
    if (e.stopPropagation) e.stopPropagation();    

    //alert('child clicked');

}; 