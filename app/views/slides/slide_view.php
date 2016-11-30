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
	<input type="submit" value="Upload File">
</form>
EOT;
		}


		public static function display_slide_options($slide) {
			?>
			<div id="slideOptionsContainer">
				<form name='slideOptions' action='?controller=slides&action=update&id=<?php echo $slide->id; ?>' method='post' id='slideOptions'>
					<div>
						<label for='name'>Name: </label>
						<input id='name' class='input' type='text' value='<?php echo $slide->name; ?>' name='name'>
					</div>
					<div>
						<label>Filename: </label><span> <?php echo $slide->name; ?></span>
					</div>
					<div>
						<label>Type: </label> <span> <?php echo $slide->type; ?></span>
					</div>
					<div>
						<label for='published'>Published? </label>
						<input class='input' type="radio" name='published' value='true'>Yes
						<input class='input' type="radio" name='published' value='false' checked>No
					</div>
					<div>
						<label for='expires'>Expires: </label>
						<input class='input' type='date' name='expires' value='<?php echo date("Y-m-j"); ?>'>
					</div>
					<div>
						<label for='caption'>Caption: </label>
						<?php $default_value = 'If you want to overlay the image with any text, enter it here.'; ?>
						<textarea class='input' name='caption' onfocus='if(this.value == "<?php echo $default_value; ?>") this.value=""; this.onfocus=null;'><?php echo (empty($slide->caption) ? $default_value : $slide->caption);?></textarea>
					</div>
					<div>
						<label>Size: </label><span> <?php echo round($slide->size/1024/1024, 2, PHP_ROUND_HALF_UP); ?> MB</span>
					</div>
					<div>
						<input class='input buttons' type='submit' name='btnSubmit' value='Save Changes'>
					</div>
					<input type='hidden' name='submitted' value='true'>
				</form>
				<form method='post' action='?controller=slides&action=delete&id=<?php echo $slide->id; ?>' name='slide_delete' id='slideDelete' name='slideDelete'>
					<div>
						<input class='input buttons' type='submit' name='delete' value='Delete Slide'>
						<input type='hidden' name='submitted' value='true'>
					</div>
				</form>
			</div>
			<img class='slide' src='<?php echo $slide->path_to_image; ?>'>
			<script src="views/slides/slide_view.js"></script>
			<?php
		}
	}
?>