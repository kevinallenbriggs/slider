<p>

<h1><?php echo $setting->setting; ?></h1>

<form action="?controller=settings&action=edit&id=<?php echo $setting->id; ?>" name="formUpload" method="post" style="background-color: grey">
	<input type="text" name="value" value="<?php echo $setting->value; ?>">
	<input type="hidden" name="inSubmitted" value="true">
	<button type="submit">Update</button>
</form>

</p>