<?php
  class Slide {
    // define the attributes stored in the database (columns)
    // they are public so that we can access them using $slide->attribute directly
    public $id;
    public $name;
    public $caption;
    public $path_to_image;
    public $publication_status;
    public $expiration_date;

    public function __construct($param) {
    	if (is_string($param)) {
    		$this->name = $param;
    	} else if (is_array($param)) {
			isset($param['id']) ? $this->id = $param['id'] : '';
    		isset($param['name']) ? $this->name = $param['name'] : '';
    		isset($param['caption']) ? $this->caption = $param['caption'] : '';
    		isset($param['path_to_image']) ? $this->path_to_image = $param['path_to_image'] : '';
    		isset($param['publication_status']) ? $this->publication_status = $param['publication_status'] : '';
    		isset($param['expiration_date']) ? $this->expiration_date = $param['expiration_date'] : '';
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
      $params = array('id' 				   => $slide['id'],
      				  'name'			   => $slide['name'],
      				  'caption'			   => $slide['caption'],
      				  'path_to_image'	   => $slide['path_to_image'],
      				  'publication_status' => $slide['publication_status'],
      				  'expiration_date'	   => $slide['expiration_date']);
      
      return new Slide($params);
    }
  }
?>