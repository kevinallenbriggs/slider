function goHome() {
	window.location.href = location.href.replace('admin.php', '');
}


function toggleLightBox(content) {
	lightbox =		document.getElementById('lightbox');
	lb_container =	lightbox.getElementsByClassName('lb_container')[0];
	
	switch (content) {
		case 'add':
			document.getElementById(content).style.display = "block";
			add_slide();
			
			break;
		case 'edit':
			console.log("toggleLightBox('edit') called");
			break;
		
		case 'del':
			console.log("toggleLightBox('del') called");
			break;
			
		default:
			break;
	}
	
	lightbox.style.display == 'none' || lightbox.style.display == '' ? lightbox.style.display = 'initial' : lightbox.style.display = 'none';

	return lightbox;
}

// THIS FUNCTION ALLOWS USERS TO ADD A SLIDE TO THE SYSTEM
function add_slide() {
	var fileselect		= document.getElementById('file_select'),
		filedrag		= document.getElementById('file_drag'),
		submitbutton	= document.getElementById('submit_button'),
		form			= document.getElementById('upload_form');
	
	// add event listener to the file_select button
	fileselect.addEventListener("change", uploadFiles, false);
	
	// check if AJAX is available
	var request = ''
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
	}
	
	function uploadFiles(submitEvent) {
		form_data = new FormData(form);
		
		if (request) {
			console.log(request + '\n');
			request.open("POST", form.getAttribute('action'), true);
			request.onload = function() {
				console.log("request.onload function triggered\n");
				if (request.status == 200) {
					console.log('file uploaded successfully (status == 200)\n');
				} else {
					console.log('file upload failed (status == ' + request.status + '\n');
				}
			}
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
