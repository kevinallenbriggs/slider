<?php
	class SlideView {

		private function __construct() {}
		private function __clone() {}

		public static function index($slides) {
			foreach($slides as $slide) {
				echo "<p><img src='$slide->path_to_image'> <a href='?controller=slides&action=get&id=$slide->id'>$slide->name</a></p>";
			}

			?>
		
			<form name="formUpload" action="/?controller=slides&action=upload" method="post" enctype="multipart/form-data">
				<input type="file" name="file">
				<input type="hidden" name="submitted" value="true">
				<button type="submit">Upload File</button>
			</form>

			<?php
		}

		public static function displayForm($slide) {
			$path = '';

			// display the properties of the slide object
			foreach($slide as $key => $value) {
				if (!empty($value)) {
					echo "<div>$key: $value</div>";
				}

				// remember the path so that it can be used to display the image
				// after all of the Slide properties are done being read
				if ($key == 'path_to_image' && !empty($value)) {
					$path = $value;
				}

				if ($key == 'id') {
					$deleteLink = "<div><a href='?controller=slides&action=remove&id=$value'>delete</a></";
				}
			}

			echo "<img src='$path' />";		// display the slide
			echo $deleteLink;
			echo "<div><a href='?controller=slides&action=index'>Back</a></div>";
		}
	}
?>