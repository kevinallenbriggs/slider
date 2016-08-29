<p>Here is a list of all slides:</p>

<?php
	foreach($slides as $slide) {
		echo "<p><img src='$slide->path_to_image'> $slide->name <a href='?controller=slides&action=show&id=$slide->id'>See content</a></p>";
	}
?>

<form name="formUpload" action="/?controller=slides&action=upload" method="post" enctype="multipart/form-data">
	<input type="file" name="inFile">
	<input type="hidden" name="inSubmitted" value="true">
	<button type="submit">Upload File</button>
</form>