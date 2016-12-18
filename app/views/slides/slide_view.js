
slide_options = document.getElementById('slideOptions');
slide_options.btnSubmit.addEventListener("click", function(e) {
	e.preventDefault();
	var caption = slide_options.caption;
	if (caption.value == 'If you want to overlay the image with any text, enter it here.') caption.value = null;
	slide_options.submit();
})