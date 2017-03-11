<?php

class Caption {

	public $id;
	public $value;
	public $color;


	public function __construct(Array $params = []) {
    foreach ($params as $key => $value) {
      isset($params[$key]) ? $this->$key = $value : $this->key = null;
    }
	}


	/**
	 * RETURNS ALL CAPTION RECORDS FROM THE DATABASE AS AN ARRAY
	 * @return an array of caption object on success
	 * @return 
	 */
	public static function all() {
		$list = [];
		$db = Db::getInstance();

		try {
			$q = $db->query('SELECT * FROM captions');

			foreach($q->fetchAll() as $caption) {
				$color = isset($caption->color) ?: null;
				$list[] = new Caption($caption->value, $color);
			}
		} catch (PDOException $e) {
			return $e->getMessage();
		}

		$db = null;
		return $list;
	}


	/**
     * RETRIEVES A SINGLE CAPTION FROM THE DATABASE
     * @param integer $id
     * @return Caption object
     */
    public static function get($id) {
      $db = Db::getInstance();		// connect to database
      
      // query database to find the caption requested
      try {
	      $r = $db->prepare('SELECT * FROM `captions` WHERE `id` = :id LIMIT 1');
	      $r->execute(array('id' => $id));
        $caption_data = $r->fetch();
        $caption_properties = [];
        foreach ($caption_data as $key => $value) {
          $caption_properties[$key] = $value;
        }
      } catch (PDOException $e) {
			 return $e->getMessage();
      }
      
      $db = null;		// disconnect from database
      
      $caption_properties = [];
      foreach ($caption_data as $key => $value) {
        if (!empty($value)) {
          $caption_properties[$key] = $value;
        }
      }

      return new Caption($caption_properties);
    }



    /** 
     * SAVE A NEW CAPTION TO THE DATABASE
     * @return caption_id on success
     */
    public function save() {

      // this function should only be used on new captions that don't have an ID in the database
    	if (isset($this->id)) return false;
      //unset($this->id);

    	try {
    		$db = Db::getInstance();
    		
    		// insert the record into the database
	        $i = 0;
	        $sql = "INSERT INTO `captions` (";
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
    	return $this->id;
    }


    /**
    * REMOVE A CAPTION FROM THE DATABASE
    * @return 1 on success
    * @return PDOException message on failure
    */
    public function remove() {

      // delete the record from the database
      try {
        $db = Db::getInstance();    // connect to database
        $q = $db->prepare("DELETE FROM `captions` WHERE `id` = :id");
        $q->execute(array('id' => $this->id));
      } catch (PDOException $e) {
        return $e->getMessage();    // something went wrong, return the error
      }

      $db = null;   // disconnect from the database
      return 1;
    }



    /**
     * UPDATE AN EXISTING CAPTION IN THE DATABASE
     * @param a caption object (optional)
     * @return 1 on success
     * @return an error message on failure
     */
    public function update() {
      try {

        $db = Db::getInstance();
        $sql = "UPDATE `captions` SET ";
        $i = 0;
        $id = $this->id;    // store the caption id
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