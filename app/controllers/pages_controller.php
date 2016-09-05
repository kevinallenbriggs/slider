<?php
  class PagesController {
  	
  	/**
  	 * CALLS THE VIEW FOR THE SLIDER (HOME) PAGE
  	 */
	public function slider() {
		// grab all the slides from the model
		require_once 'models/slide.php';
		$slides = Slide::all();
		
		// display the view
		require_once 'views/pages/slider.php';
		SliderView::displaySlider($slides);
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