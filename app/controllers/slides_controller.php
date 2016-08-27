<?php
  class SlideController {
  	
  	/**
  	 * RETRIEVES ALL THE SLIDES IN THE DATABASE TO PASS TO THE VIEW
  	 */
    public function index() {
      $slides = Slide::all();
      require_once('views/slides/index.php');
    }

    
    
    /**
     * USE THE ID IN THE URI TO RETRIEVE A SINGLE SLIDE FROM THE DATABASE
     * AND PASS THAT OBJECT TO THE VIEW
     * URI FORMAT EXPECTED IS ?controller=slides&action=show&id=x
     * WITHOUT AN ID REDIRECT TO THE ERROR PAGE
     */
    public function show() {
      if (!isset($_GET['id'])) return call('pages', 'error');

      $slide = Slide::find($_GET['id']);
      require_once('views/slides/show.php');
    }
   
    
    
    /**
     * PROCESS AN UPLOADED SLIDE FROM THE VIEW AND PASS IT TO THE MODEL
     * WE WILL ALSO CALL UPON THE VIEW TO PROVIDE USER WITH FEEDBACK
     */
    public function upload() {
    	if ($_POST['inSubmitted'] && !empty($_FILES)) {
    		$file = $_FILES['inFile'];
    		
    		// validate the submitted data
    		if ($file['type'] == 'image/jpeg') {
    			
    			// create a new Slide object which the Model layer can access
    			$slide = new Slide(array('name' => $file['name'],
    									 'path_to_image' => strtolower('uploads/' . str_replace(' ', '_', $file['name'])),
    									 'type' => $file['type'],
    									 'tmp_name' => $file['tmp_name'],
    									 'size' => $file['size']
    			));
    			
    			echo $slide->upload();
    			$slide->upload() ? require_once('views/slides/show.php') : $result;
    		}
    	}
    }
  }
?>