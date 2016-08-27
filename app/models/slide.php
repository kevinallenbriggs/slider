<?php
  class Slide {
    // define the attributes stored in the database (columns)
    // they are public so that we can access them using $slide->attribute directly
    public $id;
    public $name;
    public $caption;
    public $type;
    public $path_to_image;
    public $publication_status;
    public $expiration_date;
    public $tmp_name;

    /**
     * CREATES A NEW SLIDE OBJECT WITH EITHER JUST A NAME OR UP TO 4 OTHER PROPERTIES
     * @param unknown $param
     */
    public function __construct($param) {
    	// check to see if only a name was given
    	if (is_string($param)) {
    		$this->name = $param;
    	} else if (is_array($param)) {		// an array of property values was supplied
			isset($param['id']) ? $this->id = $param['id'] : '';
    		isset($param['name']) ? $this->name = $param['name'] : '';
    		isset($param['type']) ? $this->type = $param['type'] : '';
    		isset($param['path_to_image']) ? $this->path_to_image = $param['path_to_image'] : '';
    		isset($param['tmp_name']) ? $this->tmp_name = $param['tmp_name'] : '';
    	}
    }

    
    
    /**
     * RETURNS ALL SLIDE OBJECTS FROM THE DATABASE AS AN ARRAY
     * @return Post[] on success
     * @return PDOException message on failure
     */
    public static function all() {
      $list = [];
      $db = Db::getInstance();		// connect to database
      
      // query database
      try {
	      $req = $db->query('SELECT * FROM slides');
	
	      // loop through query results to get the property values for each Slide object that will be created
	      foreach($req->fetchAll() as $slide) {
			$params = array('id'					=>	$slide['id'],
	        				'name'					=>	$slide['name'],
	        				'caption'				=>	$slide['caption'],
	        				'path_to_image'			=>	$slide['path_to_image'],
	        				'publication_status'	=>	$slide['publication_status'],
	        				'expiration_date'		=>	$slide['expiration_date']);
			
			// create the Slide object and add it to the array of results to return
			$list[] = new Slide($params);
	      }
      } catch (PDOException $e) {
      	return $e->getMessage();	// something went wrong, return the error
      }
      
      $db = null;		// disconnect from database
      
      return $list;
    }

    
    
    /**
     * Retrieves a single slide from the database
     * @param integer $id
     * @return Slide
     */
    public static function find($id) {
      $db = Db::getInstance();		// connect to database
      $id = intval($id);			// validate input
      
      // query database
      try {
	      $req = $db->prepare('SELECT * FROM slides WHERE id = :id');
	      $req->execute(array('id' => $id));
	      $slide = $req->fetch();
      } catch (PDOException $e) {
			return $e->getMessage();
      }
      
      $db = null;		// disconnect from database
      
      return new Slide(array('id' 				   	=> $slide['id'],
      				  		 'name'			   		=> $slide['name'],
      						 'caption'			   	=> $slide['caption'],
      						 'path_to_image'	  	=> $slide['path_to_image'],
      						 'publication_status'	=> $slide['publication_status'],
      						 'expiration_date'	   	=> $slide['expiration_date']));
    }
    
    
    public function upload() {
    	// copy the file from it's temporary location in PHP
    	move_uploaded_file($this->tmp_name, 'uploads/' . $this->name);
    	
    	// insert the record into the database
    	try {
	    	$db = Db::getInstance();	// connect to database
	    	$req = $db->prepare("INSERT INTO slides (name, path_to_image, type) VALUES (:name, :path, :type)");
	    	$req->execute(array('name' => $this->name,
	    						'path' => $this->path_to_image,
	    						'type' => $this->type
	    	));
	    	
    	} catch (PDOException $e) {
    		return $e->getMessage();	// something went wrong, return the error
    	}
    	
    	$db = null;		// disconnect from the database
    }
  }
?>