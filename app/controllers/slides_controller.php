<?php
  class SlideController {
  	
  	/**
  	 * RETRIEVES ALL THE SLIDES IN THE DATABASE AND PASSES THEM TO THE VIEW
  	 */
    public function index() {
      $slides = Slide::all();		// use the model to get all the slides
      require_once('views/slides/index.php');		// call the view
    }

    
    
    /**
     * USE THE ID IN THE URI TO RETRIEVE A SINGLE SLIDE FROM THE DATABASE
     * AND PASS THAT OBJECT TO THE VIEW
     * URI FORMAT EXPECTED IS ?controller=slides&action=show&id=x
     * WITHOUT AN ID REDIRECT TO THE ERROR PAGE
     */
    public function get() {
      if (!isset($_GET['id'])) return call('pages', 'error');		// ensure that the ID is included in the request

      $slide = Slide::find(intval($_GET['id']));		// validate the input and call the Slide model to pull up the specific slide
      require_once('views/slides/show.php');			// call the view
    }
   
    
    
    /**
     * PROCESS AN UPLOADED SLIDE FROM THE VIEW AND PASS IT TO THE MODEL
     * WE WILL ALSO CALL UPON THE VIEW TO PROVIDE USER WITH FEEDBACK
     */
    public function upload() {
    	if ($_POST['inSubmitted'] && !empty($_FILES)) {		// make sure the form was submitted and a file was uploaded to PHP
    		$file = $_FILES['inFile'];		// grab the file
    		
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
    			// if successfull, call the view.  otherwise output the result
    			$slide->upload() ? require_once('views/slides/show.php') : '';
    		}
    	}
    }
  }
?>