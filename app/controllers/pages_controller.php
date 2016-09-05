<?php
  class PagesController {
  	
  	/**
  	 * CALLS THE VIEW FOR THE SLIDER (HOME) PAGE
  	 */
	public function slider() {
		SliderView::displaySlider();
    }

    
    /**
     * CALLS THE VIEW FOR THE ERROR PAGE
     */
    public function error() {
      ErrorView::displayError();
    }
  }
?>