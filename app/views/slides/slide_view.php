<?php
	class SlideView {

		private function __construct() {}
		private function __clone() {}

		public static function index($slides) {
			echo "<ul id='slideList'>";
			foreach($slides as $slide) {
				echo  "<li class='slide'><a href='?controller=slides&action=edit&id=$slide->id'><img src='uploads/$slide->filename' class='thumbnail'>";
				if ($slide->published && (strtotime($slide->expires) - time() > 0 || $slide->expires == '0000-00-00')) echo "<img src='assets/checkmark.png' class='checkmark'>";
				echo "$slide->name</a></li>";
			}

			echo "<li class='slide'><a href='?controller=slides&action=new_slide_form'><img src='assets/plus.png' id='addSlide'>New Slide...</a></li></ul>";
		}



		public static function display_new_slide_form() {
			echo <<<EOT
<form name="formUpload" action="/?controller=slides&action=create" method="post" enctype="multipart/form-data" id="slideUpload">
	<input type="file" name="file">
	<input type="hidden" name="submitted" value="true">
	<input type="submit" value="Upload File">
</form>
EOT;
		}


		public static function display_slide_options($slide) {
			/*echo "<tt><pre>";
			echo htmlentities($slide->name);
			echo "</pre></tt>";*/
			?>
			<div id="slideOptionsContainer">
				<form name='slideOptions' action='?controller=slides&action=update&id=<?php echo $slide->id; ?>' method='post' id='slideOptions'>
					<div>
						<label for='name'>Name: </label>
						<input id='name' class='input' type='text' value="<?php echo htmlentities($slide->name); ?>" name='name'>
					</div>
					<div>
						<label>Filename: </label><span> <?php echo $slide->filename; ?></span>
					</div>
					<div>
						<label>Type: </label> <span> <?php echo $slide->type; ?></span>
					</div>
					<div>
						<label for='published'>Published? </label>
						<input class='input' type="radio" name='published' value='1' <?php if ($slide->published) echo 'checked'; ?> >Yes
						<input class='input' type="radio" name='published' value='0' <?php if (!$slide->published) echo 'checked'; ?> >No
					</div>
					<div>
						<label for='expires'>Expires: </label>
						<input class='input' type='date' name='expires' value="<?php echo $slide->expires; ?>">
					</div>
					<div>
						<label for='caption'>Caption: </label>
						<?php $default_value = ($slide->caption ?: 'If you want to overlay the image with any text, enter it here.'); ?>
						<textarea class='input' name='caption' onfocus='if(this.value == "<?php echo $default_value; ?>") this.value=""; this.onfocus=null;'><?php echo $default_value; ?></textarea>
					</div>
					<div>
						<label>Size: </label><span> <?php echo round($slide->size/1024/1024, 2, PHP_ROUND_HALF_UP); ?> MB</span>
					</div>
					<div>
						<input class='input buttons' type='submit' name='btnSubmit' value='Save Changes'>
					</div>
					<input type='hidden' name='submitted' value='true'>
				</form>
				<form method='post' action='?controller=slides&action=destroy&id=<?php echo $slide->id; ?>' name='slide_delete' id='slideDelete' name='slideDelete'>
					<div>
						<input class='input buttons' type='submit' name='delete' value='Delete Slide'>
						<input type='hidden' name='submitted' value='true'>
					</div>
				</form>
			</div>
			<img class='slideImage' src='<?php echo 'uploads/' . $slide->filename; ?>'>
			<script src="views/slides/slide_view.js"></script>
			<?php
		}


		// display the slider
		public static function display_slideshow($slides, $duration) {

			$numSlides = count($slides);
			$i = 1;
			echo '<div class="slideshow-container">';
			
			foreach ($slides as $slide) {
				if ((strtotime($slide->expires) - time() > 0 || $slide->expires == '0000-00-00') && $slide->published) {
					echo '<div class="mySlides fade">' .
						 "<img src='uploads/$slide->filename'>" .
						 "<div class='caption'>$slide->caption</div>" .
						 "</div>";
					$i++;
				}
			}

			if ($i <= 1) echo "<div class='noSlides'>There are no slides set to display.<br>Check to make sure slides are published and not expired.</div>"
			?>

			</div> <!-- .slideshow-container -->
			<script>var duration = <?php echo $duration; ?>;</script>
			<script src="views/slides/slider.js"></script>

			<?php
		}		// end of function displaySlider
	}
?>