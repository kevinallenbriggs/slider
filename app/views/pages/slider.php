<?php
	class SliderView {
		
		// disable creation of SliderView objects
		private function __construct() {}
		private function __clone() {}
		
		// display the slider
		public static function displaySlider($slides, $duration) {

			$numSlides = count($slides);
			$i = 1;
			echo '<div class="slideshow-container">';
			
			foreach ($slides as $slide) {
				if (strtotime($slide->expires) - time() > 0 && $slide->published) {
					echo '<div class="mySlides fade">' .
						 "<img src='uploads/$slide->filename'>" .
						 "<div class='text'>$slide->caption</div>" .
						 "</div>";
					$i++;
				}
			}

			if ($i <= 1) echo "<div class='noSlides'>There are no slides in the database.</div>"
			?>

			</div> <!-- .slideshow-container -->
			<script>var duration = <?php echo $duration; ?>;</script>
			<script src="views/pages/slider.js"></script>

			<?php
		}		// end of function displaySlider
	}
?>
