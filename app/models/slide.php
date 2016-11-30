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
    public $size;

    /**
     * CREATES A NEW SLIDE OBJECT REQUIRING AT LEAST A NAME BUT WITH UP TO 6 OTHER PROPERTIES
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
    		isset($param['size']) ? $this->size = $param['size'] : '';
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
	      $r = $db->query('SELECT * FROM slides');
	
	      // loop through query results to get the property values for each Slide object that will be created
	      foreach($r->fetchAll() as $slide) {
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
    public static function get($id) {
      $db = Db::getInstance();		// connect to database
      
      // query database to find the slide requested
      try {
	      $r = $db->prepare('SELECT * FROM slides WHERE id = :id');
	      $r->execute(array('id' => $id));
	      $slide = $r->fetch();
      } catch (PDOException $e) {
			 return $e->getMessage();
      }
      
      $db = null;		// disconnect from database
      
      $slide_properties = [];
      foreach ($slide as $key => $value) {
        (!empty($value)) ? $slide_properties[$key] = $value : '';
      }

      return new Slide($slide_properties);
    }
    


    /**
     * UPLOAD A NEW SLIDE INTO THE DATABASE AND FILESYSTEM
     * @return 1 on success
     * @return PDOException message on failure
     */
    public function upload() {
    	// copy the file from it's temporary location in PHP
    	move_uploaded_file($this->tmp_name, 'uploads/' . $this->name);
    	
    	// insert the record into the database
    	try {
	    	$db = Db::getInstance();	// connect to database
	    	$r = $db->prepare("INSERT INTO `slides` (`name`, `path_to_image`, `type`, `size`) VALUES (:name, :path_to_image, :type, :size)");
	    	$r->execute(array('name' => $this->name,
	    						'path_to_image' => $this->path_to_image,
	    						'type' => $this->type,
	    						'size' => $this->size));
    	} catch (PDOException $e) {
    		return $e->getMessage();	// something went wrong, return the error
    	}
    	
    	$db = null;		// disconnect from the database
    	return 1;
    }


    /**
    * REMOVE A SLIDE FROM THE DATABASE AND FILESYSTEM
    * @return 1 on success
    * @return PDOException message on failure
    */
    public function remove() {
      // remove the slide from the filesystem
      if (file_exists($this->path_to_image)) {    // delete file if it exists otherwise return 0
        unlink($this->path_to_image);
      } else {
        return 0;
      }  

      // delete the record from the database
      try {
        $db = Db::getInstance();    // connect to database
        $r = $db->prepare("DELETE FROM `slides` WHERE `id` = :id");
        $r->execute(array('id' => $this->id));
      } catch (PDOException $e) {
        return $e->getMessage();    // something went wrong, return the error
      }

      $db = null;   // disconnect from the database
      return 1;
    }



    public function update($params) {
      $i = 0;   // initialize index necessary inside foreach loop below
      $sql = "UPDATE `slides` SET ";  // all update statements will begin the same way

      // loop through the parameters to build the statement
      foreach ($params as $key => $value) {
        $sql .= "`$key` = '$value'";

        // include a comma and space after every parameter except the last one
        if (++$i === count($params)) {
          $sql .= ' ';
        } else {
          $sql .= ', ';
        }
      }

      // finish building the prepared statement
      $sql .= " WHERE `slides`.`id` = :id";

      // execute the prepared statement
      try {
        $db = Db::getInstance();    // connect to database
        $r = $db->prepare($sql);    // create the PDO object
        $r->execute(array(':id' => $this->id));   // execute the PDO object
      } catch (PDOException $e) {   // catch any errors
        return $e->getMessage();
        //return false;
      }

      $db = null;   // close the connection to the database
      return true;
    }
  }
?>