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
			document.getElementById('add').style.display = "block";
			
			// check if the W3C File API is available in this browser
			if (window.File && window.FileList && window.FileReader) {
				var fileselect		= document.getElementById('file_select'),
					filedrag		= document.getElementById('file_drag'),
					submitbutton	= document.getElementById('submit_button');
				
				// add event listener to the file_select button
				fileselect.addEventListener("change", fileSelectHandler, false);
				
				// check if AJAX is available
				var xhr = new XMLHttpRequest();
				if (xhr.upload) {
					// add event handlers for file drag n drop
					filedrag.addEventListener("dragover", fileDragHover, false);
					filedrag.addEventListener("dragleave", fileDragHover, false);
					filedrag.addEventListener("drop", fileSelectHandler, false);
					filedrag.style.display = "block";
					
					// remove the submit button since we'll be doing it automatically
					submitbutton.style.display = 'none';
				}
				
				function fileDragHover(event) {
					event.stopPropagation();		// cancel events
					event.preventDefault();			// cancel events
					
					// change the pseudo class of the calling object
					event.target.className = (event.type == "dragover" ? "hover" : "");
				}
				
				function fileSelectHandler(event) {
					fileDragHover(event);		// cancel events and remove hover styles
					
					// fetch the FileList object
					var files = event.target.files || event.dataTransfer.files;
					
					// process the File objects
					for (var i = 0, file; file = files[i]; i++) {
						parseFile(file);
					}
				}
				
				function parseFile(file) {
					console.log("parseFile() called");
					debug(	"<File information:<br" + 
							"<b>Name: </b>" + file.name + "<br>" +
							"<b>Type: </b>" + file.type + "<br>" +
							"<b>Size: </b>" + file.size + " bytes");
				}
			}
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

function debug(msg) {
	console.log("Debug: " + msg);
}
