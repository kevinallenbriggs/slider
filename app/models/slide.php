<?php
  class Slide {
    // define the attributes stored in the database (columns)
    // they are public so that we can access them using $slide->attribute directly
    public $id;
    public $name;
    public $caption;
    public $type;
    public $path_to_image;
    public $published;
    public $expires;
    public $tmp_name;
    public $size;


    /**
     * CREATES A NEW SLIDE OBJECT REQUIRING AT LEAST A NAME BUT WITH UP TO 6 OTHER PROPERTIES
     * @param unknown $param
     */
    public function __construct($params) {
      // check to see if only a name was given
      if (is_string($params)) {
        $this->name = $params;
      } else if (is_array($params)) {    // an array of property values was supplied
         foreach ($params as $key => $value) {
          isset($params[$key]) ? $this->$key = $value : '';
         }
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
			         $params = array('id'            =>	$slide['id'],
	        				             'name'          =>	$slide['name'],
	        				             'caption'			 =>	$slide['caption'],
	        				             'path_to_image' =>	$slide['path_to_image'],
	        				             'published'	   =>	$slide['published'],
	        				             'expires'       =>	$slide['expires']);
			
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
	      $r = $db->prepare('SELECT * FROM slides WHERE id = :id LIMIT 1');
	      $r->execute(array('id' => $id));
        $slide_data = $r->fetch();
      } catch (PDOException $e) {
			 return $e->getMessage();
      }
      
      $db = null;		// disconnect from database
      
      $slide_properties = [];
      foreach ($slide_data as $key => $value) {
        if (!empty($value)) {
          $slide_properties[$key] = $value;
        }
      }

      return new Slide($slide_properties);
    }
    


    /**
     * UPLOAD A NEW SLIDE INTO THE DATABASE AND FILESYSTEM
     * @return 1 on success
     * @return PDOException message on failure
     */
    public function save() {
      unset($this->id);   //ensure this is saved as a new slide

    	// copy the file from it's temporary location in PHP
      try {
        if (file_exists($this->tmp_name) && !move_uploaded_file($this->tmp_name, 'uploads/' . $this->name)) {
          throw new Exception('Could not move file');
        }
        unset($this->tmp_name);
      } catch (Exception $e) {
        return $e->getMessage();
      }
    	
    	// insert the record into the database
    	try {
	    	$db = Db::getInstance();	// connect to database
        $i = 0;
        $sql = "INSERT INTO `slides` (";
        $prepared_values = array();
        $count = count((array)$this);
        foreach ((array)$this as $key => $value) {
          ++$i;
          $sql .= "`$key`";
          $sql .= ($i === $count ? ") VALUES (" : ", ");
          $prepared_values[$key] = $value;
        }

        $i = 0;
        foreach ($this as $key => $value) {
          ++$i;
          $sql .= ":$key";
          $sql .= ($i === $count ? ")" : ", ");
        }

	    	$r = $db->prepare($sql);
	    	$r->execute($prepared_values);
    	} catch (PDOException $e) {
    		return $e->getMessage();	// something went wrong, return the error
    	}
    	
      $this->id = (int)$db->lastInsertId('id');
    	$db = null;		// disconnect from the database
    	return 1;
    }


    /**
    * REMOVE A SLIDE FROM THE DATABASE AND FILESYSTEM
    * @return 1 on success
    * @return PDOException message on failure
    */
    public function remove($skip_filesystem = false) {
      // remove the slide from the filesystem
      if (file_exists($this->path_to_image)) {    // delete file if it exists otherwise return 0
        unlink($this->path_to_image);
      } elseif (!$skip_filesystem) {
        return 'Could not find file';
      }  

      // delete the record from the database
      try {
        $db = Db::getInstance();    // connect to database
        $q = $db->prepare("DELETE FROM `slides` WHERE `id` = :id");
        $q->execute(array('id' => $this->id));
      } catch (PDOException $e) {
        return $e->getMessage();    // something went wrong, return the error
      }

      $db = null;   // disconnect from the database
      return 1;
    }


    /**
     * UPDATE AN EXISTING RECORD IN THE DATABASE
     * @return 1 on success
     * @return an error message on failure
     */
    public function update() {
      try {
        $db = Db::getInstance();
        $sql = "UPDATE `slides` SET ";
        $i = 0;
        $id = $this->id;
        unset($this->id, $this->tmp_name);
        foreach ($this as $key => $value) {
          if (!$value) $value = NULL;

          $sql .= "`$key` = :$key";    // loop through each property of the object and add value to sql statement
          $sql .= (++$i === count((array)$this) ? " " : ", ");   // add a comma after every parameter except the last one
        }
        $sql .= "WHERE `id` = :id";

        $q = $db->prepare($sql);

        $prepared_values = array('id' => $id);

        foreach ($this as $key => $value) {
          $prepared_values[$key] = $value;
        }
        
        $q->execute($prepared_values);
        $this->id = $id;

      } catch (PDOException $e) {
        return $e->getMessage();
        //return $sql;
      }

      $db = null;
      return 1;
    }
  }
?>