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
			
			// check the status of our upload
			request.onreadystatechange = function(){
				if(request.readyState == 4){
					try {
						console.log(request.responseText);
					} catch (e){
						var resp = {
								status: 'error',
								data: 'Unknown error occurred: [' + request.responseText + ']'
						};
					}
					
					var message = request.status + ': ' + request.statusText;
					console.log(message);
					$output = document.getElementById('uploads');
					$output.innerHTML = message;
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
