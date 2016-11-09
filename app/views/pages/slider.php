<?php
	class SliderView {
		
		// disable creation of SliderView objects
		private function __construct() {}
		private function __clone() {}
		
		// display the slider
		public static function displaySlider($slides) {

			$numSlides = count($slides);
			$i = 1;
			echo '<div class="slideshow-container">';
			
			foreach ($slides as $slide) {

				// TODO: add check for aspect ratio so that image can be displayed without scrolling

				echo '<div class="mySlides fade">' .
					 "<img src='$slide->path_to_image'>" .
					 "<div class='text'>$slide->caption</div>" .
					 "</div>";
				$i++;
			}
			
			?>

			</div> <!-- .slideshow-container -->
			<br>

			<?php
		}		// end of function displaySlider
	}
?>
