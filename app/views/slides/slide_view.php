<?php
	class SlideView {

		private function __construct() {}
		private function __clone() {}

		public static function index($slides) {
			echo "<ul class='slideList'>";
			foreach($slides as $slide) {
				echo  "<li><a href='?controller=slides&action=edit&id=$slide->id'><img src='$slide->path_to_image'></a></li>";
			}

			echo "<li class='addSlide'><a href='?controller=slides&action=new'><img src='assets/plus.png'></a></li></ul>";
		}



		public static function display_new_slide_form() {
			echo <<<EOT
<form name="formUpload" action="/?controller=slides&action=upload" method="post" enctype="multipart/form-data" id="slideUpload">
	<input type="file" name="file">
	<input type="hidden" name="submitted" value="true">
	<button type="submit">Upload File</button>
</form>
EOT;
		}


		public static function display_slide_options($slide) {
			?>

			<form name='slide_options' action='?controller=slides&action=update&id=<?php echo $slide->id; ?>' method='post' id='slideOptions'>
				<div>
					<label for='slideName'>Name: </label>
					<input type='text' value='<?php echo $slide->name; ?>' name='slideName'>
				</div>
				<div>
					<label>Filename: </label><?php echo $slide->name; ?>
				</div>
				<div>
					<label>Type: </label> <?php echo $slide->type; ?>
				</div>
				<div>
					<label for='published'>Published? </label>
					<input type="radio" name='published' value='true'>Yes
					<input type="radio" name='published' value='false' checked>No
				</div>
				<div>
					<label for='expires'>Expires: </label>
					<input type='date' name='expires' value='<?php echo date("Y-m-j"); ?>'>
				</div>
				<div>
					<label for='caption'>Caption: </label>
					<input type='text' name='caption'>
				</div>
				<div>
					<label>Size: </label><?php echo round($slide->size/1024/1024, 2, PHP_ROUND_HALF_UP); ?> MB
				</div>
				<div>
					<input type='submit' name='submit' value='Save Changes'>
				</div>
				<div>
					<input type='button' name='delete' value='Delete Slide'>
				</div>
				<input type='hidden' name='submitted' value='true'>
			</form>
			<img class='slide' src='<?php echo $slide->path_to_image; ?>'>

			<?php
		}
	}
?>