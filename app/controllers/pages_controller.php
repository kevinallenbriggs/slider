<?php
  class PagesController {
  	
    /**
     * CALLS THE VIEW FOR THE SLIDER (HOME) PAGE
     */
    public function slider() {
		    // grab all the slides from the model
		    require_once 'models/slide.php';
		    $slides = Slide::all();

            require_once 'models/setting.php';
            $settings = Setting::all();
            foreach ($settings as $setting) {
                if ($setting->name == "slide duration") $duration = (int)$setting->value;
            }
		
    		// display the view
    		require_once 'views/pages/slider.php';
    		SliderView::displaySlider($slides, $duration);
        }

    
        /**
         * CALLS THE VIEW FOR THE ERROR PAGE
         */
        public function error() {
        	require_once 'views/pages/error.php';
    		  ErrorView::displayError();
        }
  }
?>