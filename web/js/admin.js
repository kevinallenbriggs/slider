function goHome() {
	window.location.href = location.href.replace('admin.php', '');
}


function toggleLightBox(id) {
	if (id === undefined) {
		id = 'lightbox';
	}
	
	lightbox = document.getElementById('lightbox');
	lightbox.style.display == 'none' || lightbox.style.display == '' ? lightbox.style.display = 'initial' : lightbox.style.display = 'none';

}

// THIS FUNCTION ALLOWS USERS TO ADD A SLIDE TO THE SYSTEM
function add_slide() {
	toggleLightBox();
}


// THIS FUNCTION ALLOWS USERS TO EDIT THE PARAMETERS OF A SLIDE
function edit() {
	toggleLightBox();
}


// THIS FUNCTION REMOVES A SLIDE (AND ITS ASSOCIATED PARAMETERS) FROM THE SYSTEM
function del() {
	
}