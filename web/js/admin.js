function goHome() {
	window.location.href = location.href.replace('admin.php', '');
}


function toggleLightBox(content, id) {
	if (id === undefined) {
		id = 'lightbox';
	}
	
	lightbox =		document.getElementById(id);
	lb_container =	lightbox.getElementsByClassName('lb_container')[0];
	
	switch (content) {
		case 'add':
			$add_slide_form = 	'<h1>Add a Slide</h1>' +
								'<form action="" method="post" id="url-form">' +
								'<input type="hidden" name="url_submitted" value="true">' +
								'<input type="url" value="URL">' +
								'<input type="submit" value="Download">' +
								'</form>' +
								'<form action="" method="post" enctype="multiport/form-data" id="file-form">' +
								'<input type="hidden" name="file_submitted" value="true">' +
								'<input type="file" name="fileselect[]" id="file-select" multiple="multiple">' +
								'<button type="submit" id="file-upload-button">Upload</button>' +
								'</form>';
			console.log(lightbox);
			lb_container.innerHTML = $add_slide_form;
			break;
		case 'edit':
			$edit_form = '';
			break;
		
		case 'del':
			$del_form =	'';
			break;
			
		default:
			break;
	}
	
	lightbox.style.display == 'none' || lightbox.style.display == '' ? lightbox.style.display = 'initial' : lightbox.style.display = 'none';

	return lightbox;
}

// THIS FUNCTION ALLOWS USERS TO ADD A SLIDE TO THE SYSTEM
function add_slide() {
	toggleLightBox('add');
	
	var form =			document.getElementById('file-form');
	var fileSelect =	document.getElementById('file-select');
	
	form.onsubmit = function(event) {
						event.preventDefault();		// stop the form from submitting
						document.getElementById('file-upload-button').innerHTML = 'Uploading...';		// THIS SHOULD BE REPLACED WITH A FANCY SPINNER OR SOMETHING
						
						var files = document.getElementById('file-select').files;	// get the selected files from the input element
						var formData = new FormData();	// create the formData object that will construct the key/value pairs for AJAX
						
						// loop through each of the uploaded files
						for (var i = 0; i < files.length; i++) {
							var file = files[i];
							
							// check the file type
							if(!file.type.match(/^(image)\/.*/ )) {
								console.log('file.type is not an image: ' + file.type);
								continue;
							} else {
								console.log('file.type is an image: ' + file.type);
							}
							
							// add the file to the request
							formData.append('uploads[]', file, file.name);
							
							// set up the AJAX request and open the connection
							var ajax = new XMLHttpRequest();

							ajax.open('POST', 'upload.php', true);
							
							// set up a handler for event completion
							ajax.onload = function() {
												if(ajax.status === 200) {
													// files uploaded
													uploadButton.innerHTML('Upload');
												} else {
													// ERROR HANDLING GOES HERE
													console.log('An ajax error occurred. -KAB');
												}
										  };	// end of ajax.onload
										  
							// send the data
							ajax.send(formData);
						}
					}	// end of form.onsubmit
}




// THIS FUNCTION ALLOWS USERS TO EDIT THE PARAMETERS OF A SLIDE
function edit() {
	toggleLightBox('edit');
}


// THIS FUNCTION REMOVES A SLIDE (AND ITS ASSOCIATED PARAMETERS) FROM THE SYSTEM
function del() {
	toggleLightBox('del');
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