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

    public function __construct($param) {
    	if (is_string($param)) {
    		$this->name = $param;
    	} else if (is_array($param)) {
			isset($param['id']) ? $this->id = $param['id'] : '';
    		isset($param['name']) ? $this->name = $param['name'] : '';
    		isset($param['type']) ? $this->type = $param['type'] : '';
    		isset($param['path_to_image']) ? $this->path_to_image = $param['path_to_image'] : '';
    		isset($param['tmp_name']) ? $this->tmp_name = $param['tmp_name'] : '';
    	}
    }

    /**
     * Returns all slide objects from the database as an array
     * @return Post[]
     */
    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM slides');
	  
      // we create a list of slide objects from the database results
      foreach($req->fetchAll() as $slide) {
      	$params = array('id'=>$slide['id'],
        				'name'=>$slide['name'],
        				'caption'=>$slide['caption'],
        				'path_to_image'=>$slide['path_to_image'],
        				'publication_status'=>$slide['publication_status'],
        				'expiration_date'=>$slide['expiration_date']);
		$list[] = new Slide($params);
      }
      
      return $list;
    }

    /**
     * Retrieves a single slide from the database
     * @param integer $id
     * @return Slide
     */
    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM slides WHERE id = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $slide = $req->fetch();
      $db = null;
      $params = array('id' 				   => $slide['id'],
      				  'name'			   => $slide['name'],
      				  'caption'			   => $slide['caption'],
      				  'path_to_image'	   => $slide['path_to_image'],
      				  'publication_status' => $slide['publication_status'],
      				  'expiration_date'	   => $slide['expiration_date']);
      
      return new Slide($params);
    }
    
    
    public function upload() {
    	// copy the file from it's temporary location in PHP
    	move_uploaded_file($this->tmp_name, 'uploads/' . $this->name);
    	
    	// insert the record into the database
    	try {
	    	$db = Db::getInstance();
	    	$req = $db->prepare("INSERT INTO slides (name, path_to_image, type) VALUES (:name, :path, :type)");
	    	$req->execute(array('name' => $this->name,
	    						'path' => $this->path_to_image,
	    						'type' => $this->type
	    	));
	    	
    	} catch (PDOException $e) {
    		return $e->getMessage();
    	}
    	
    	$db = null;
    }
  }
?>