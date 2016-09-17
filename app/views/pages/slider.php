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
					 "<div class='numbertext'>$i / $numSlides</div>" .
					 "<img src='$slide->path_to_image'>" .
					 "<div class='text'>$slide->caption</div>" .
					 "</div>";
				$i++;
			}
			
			?>

				<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
				<a class="next" onclick="plusSlides(1)">&#10095;</a>
			</div>
			<br>

			<div style="text-align:center">
  				<span class="dot" onclick="currentSlide(1)"></span> 
  				<span class="dot" onclick="currentSlide(2)"></span> 
  				<span class="dot" onclick="currentSlide(3)"></span> 
			</div>
			<script src="views/pages/slider.js"></script>

			<?php
		
		}		// end of function displaySlider
	}
?>
