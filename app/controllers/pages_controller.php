<?php
  class PagesController {

    
        /**
         * CALLS THE VIEW FOR THE ERROR PAGE
         */
        public function error() {
        	require_once 'views/pages/error.php';
    		  ErrorView::displayError();
        }
  }
?>