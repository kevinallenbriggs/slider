<?php
  class PagesController {
  	
  	/**
  	 * CALLS THE VIEW FOR THE HOME PAGE
  	 */
    public function home() {
      require_once('views/pages/home.php');
    }

    
    /**
     * CALLS THE VIEW FOR THE ERROR PAGE
     */
    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>