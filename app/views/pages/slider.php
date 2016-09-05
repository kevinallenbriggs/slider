<?php
	class SliderView {
		
		private function __construct() {}
		private function __clone() {}
		
		public static function displaySlider($slides) {
			$i = 1;
			echo '<div class="slideshow-container">';
			
			foreach ($slides as $slide) {
				echo '<div class="mySlides fade">';
				echo "<div class='numbertext'>$i / 3</div>";
				echo "<img src='$slide->path_to_image' style='width:100%'>";
				echo "<div class='text'>$slide->caption</div>";
				echo "</div>";
				$i++;
			}
			
			echo <<<_EOT

  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>
_EOT;
		
		}
	}
	
?>
