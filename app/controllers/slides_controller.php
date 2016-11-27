<?php
  class SlideController {
  	
  	/**
  	 * RETRIEVES ALL THE SLIDES IN THE DATABASE AND PASSES THEM TO THE VIEW
  	 */
    public function index() {
      $slides = Slide::all();		// use the model to get all the slides
      SlideView::index($slides);    // call the view
    }

    
    
    /**
     * USE THE ID IN THE URI TO RETRIEVE A SINGLE SLIDE FROM THE DATABASE
     * AND PASS THAT OBJECT TO THE VIEW
     * URI FORMAT EXPECTED IS ?controller=slides&action=show&id=x
     * WITHOUT AN ID REDIRECT TO THE ERROR PAGE
     */
    public function get() {
      if (!isset($_GET['id'])) return call('pages', 'error');		// ensure that the ID is included in the request

      $slide = Slide::get(intval($_GET['id']));		// validate the input and call the Slide model to pull up the specific slide
      SlideView::displayForm($slide);   // call the view
    }


    public function create() {}
   
    
    
    /**
     * PROCESS AN UPLOADED SLIDE FROM THE VIEW AND PASS IT TO THE MODEL
     * WE WILL ALSO CALL UPON THE VIEW TO PROVIDE USER WITH FEEDBACK
     */
    public function upload() {
    	if ($_POST['submitted'] && !empty($_FILES)) {		// make sure the form was submitted and a file was uploaded to PHP
    		$file = $_FILES['file'];		// grab the file
    		
    		// validate the submitted data
    		if ($file['type'] == 'image/jpeg') {
    			
    			// create a new Slide object which the Model layer can access
    			$slide = new Slide(array('name' => $file['name'],
    									 'path_to_image' => strtolower('uploads/' . str_replace(' ', '_', $file['name'])),
    									 'type' => $file['type'],
    									 'tmp_name' => $file['tmp_name'],
    									 'size' => $file['size']
    			));
    			
    			// upload the slide
          // TODO: provide a redirection to the slide index page if upload was a success
    			$slide->upload();
    		}
    	}
    }


    public function remove() {
      if (!isset($_GET['id'])) return call('pages', 'error');    // ensure that the ID is included in the request

      Slide::get(intval($_GET['id']))->remove();  // retrieve the slide info from the database and remove it
    }
  }
?>