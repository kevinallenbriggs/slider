<?php
	class SlideView {

		private function __construct() {}
		private function __clone() {}

		public static function index($slides) {
			foreach($slides as $slide) {
				echo "<p><img src='$slide->path_to_image'> $slide->name <a href='?controller=slides&action=get&id=$slide->id'>See content</a></p>";
			}

			?>
		
			<form name="formUpload" action="/?controller=slides&action=upload" method="post" enctype="multipart/form-data">
				<input type="file" name="inFile">
				<input type="hidden" name="inSubmitted" value="true">
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
			}

			echo "<img src='$path' />";		// display the slide
			echo "<div><a href='?controller=slides&action=index'>Back</a></div>";
		}
	}
?>