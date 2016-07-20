function goHome() {
	window.location.href = location.href.replace('admin.php', '');
}


function toggleLightBox(content) {
	lightbox =	document.getElementById('lightbox');
	
	// grab all the lightbox options and make sure they're all reset every time this is called
	add = document.getElementById('add'), edit = document.getElementById('edit'), del = document.getElementById('remove');
	add.style.display = edit.style.display = del.style.display = 'none';
	
	switch (content) {
		case 'add': add.style.display = 'block'; add_slides(); console.log("toggleLightBox('add') called"); break;
		case 'edit': edit.style.display = 'block'; console.log("toggleLightBox('edit') called"); break;
		case 'del': del.style.display = 'block'; console.log("toggleLightBox('del') called"); break;
		default: break;
	}
	
	lightbox.style.display == 'none' || lightbox.style.display == '' ? lightbox.style.display = 'initial' : lightbox.style.display = 'none';

	return lightbox;
}

// THIS FUNCTION ALLOWS USERS TO ADD A SLIDE TO THE SYSTEM
function add_slides() {
	var fileselect		= document.getElementById('file_select'),
		filedrag		= document.getElementById('file_drag'),
		submitbutton	= document.getElementById('submit_button'),
		form			= document.getElementById('upload_form');
	
	// add event listener to the file_select button
	fileselect.addEventListener("change", uploadFiles, false);
	
	// check if AJAX is available
	var request = new XMLHttpRequest();
	if (request.upload) {
		
		// define what to do when files are dragged into the #filedrag div
		function fileDragHandler(event) {
			event.stopPropagation();	// prevents event bubbling
			event.preventDefault();		// prevent default action (like opening the picture in the browser window)
			
			// change the pseudo class of the calling object
			event.target.className = (event.type == "dragover" ? "hover" : "");
			
			// handle the file uploads if files were dropped on the element
			if (event.type === 'drop') uploadFiles(event);
		}
		
		// add event handlers for file drag n drop
		filedrag.addEventListener("dragover", fileDragHandler, false);
		filedrag.addEventListener("dragleave", fileDragHandler, false);
		filedrag.addEventListener("drop", fileDragHandler, false);
		filedrag.style.display = "block";
		
	} else {		// automatic form submittal isn't going to work; display the submit button
		submitbutton.style.display = 'inline-block';
	}
	
	function uploadFiles(submitEvent) {		
		if (request) {		// check to make sure XMLHttpRequest is supported
			request.open("POST", form.getAttribute('action'), true);	// open the request
			form_data = new FormData();		// create the FormData object
			
			// append information to the form so that the PHP backend
			// knows if AJAX was used or the form was submitted normally
			if (submitEvent.target.id == 'file_drag') {
				form_data.append('file_drag', true);
			} else {
				form_data.append('file_select', true);
			}
			
			// add all the files to the FormData object
			var files = submitEvent.target.files || submitEvent.dataTransfer.files;
			for (var i = 0, file; file = files[i]; i++) {
				form_data.append('file' + (i + 1), file);
			}
			
			// prepare upload_feedback to receive previews of the uploaded images
			upload_feedback = document.getElementById('upload_feedback');	// get the upload_feedback ul
			var clone = upload_feedback.cloneNode(true);		// clone upload feedback to mess with content
			upload_feedback.innerHTML = '<div>Processing uploads...</div>';		// display message to user while we create previews
			
			
			// check for upload completion
			request.onreadystatechange = function(){
				if(request.readyState == 4){
					var response = request.responseText;	// grab the returned html from admin.php
					
					// create the preview of successfully uploaded files
					clone.innerHTML = response;			// copy the response into our clone of #upload_feedback
					var list_items = clone.getElementsByTagName('li');		// get all the li elements within the clone
					if (list_items.length > 0) {			// make sure there were elements created
						// go through each li to add the img tag
						for (var i = 0, file; i < list_items.length; i++) {
							file = list_items[i];
							file.innerHTML = '<img src="uploads/' + file.innerHTML + '">';	// add img element to each li
							var img = file.getElementsByTagName('img')[0];
							//img.naturalWidth > img.naturalHeight ? img.style.width = "100%" : img.style.width = "100%";
							upload_feedback.innerHTML = "<p>Successful Uploads:</p>" + clone.innerHTML;		// copy our clone into the original element which is displayed
							console.log("upload_feedback.style.border: " + upload_feedback.style.border);
							if (upload_feedback.style.border == '') {
								upload_feedback.style.border = '1px solid green';
							}
						}
					} else upload_feedback.innerHTML = "There was an error uploading at least one of the files.";
				}
			};
			
			// send the request to the server
			request.send(form_data);
			
		} else {
			// ajax is not available, submit form manually
			form.submit();
		}
	}
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
}

/**
 * 
 * @param content - the #id of the DOM element to act upon
 * @param property - the CSS property to modify, default is 'display'
 * @param value	- the value of the CSS property to modify, default is 'block'
 */
function css(content, property, value) {
	!property ? property = 'display' : property = property;		// value is 'display' by default
	!value ? value = 'block' : value = value;	// value is 'block' by default
	document.getElementById(content).style[property] = value;
}
