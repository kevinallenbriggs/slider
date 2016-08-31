<?php
  class PagesController {
  	
  	/**
  	 * CALLS THE VIEW FOR THE HOME PAGE
  	 */
	public function slider() {
		require_once('views/pages/slider.php');
    }

    
    /**
     * CALLS THE VIEW FOR THE ERROR PAGE
     */
    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>