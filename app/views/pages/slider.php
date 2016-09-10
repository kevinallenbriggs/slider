<?php
	class SliderView {
		
		// disable creation of SliderView objects
		private function __construct() {}
		private function __clone() {}
		
		// display the slider
		public static function displaySlider($slides) {
			$i = 1;
			?><div class="slideshow-container"><?php
			
			foreach ($slides as $slide) {
				echo '<div class="mySlides fade">' .
					 "<div class='numbertext'>$i / 3</div>" .
					 "<img src='$slide->path_to_image' style='width:100%'>" .
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
			<?php
		
		}		// end of function displaySlider
	}
?>
