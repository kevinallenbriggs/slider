<?php
	class Setting {
		// define the attributes stored in the database (columns)
		// they are public so that we can access them using $setting->attribute directly
		public $id;
		public $name;
		public $value;
		
		
		/**
		 * CREATES A NEW SETTING OBJECT THAT REQUIRES BOTH A NAME AND VALUE
		 * @param unknown $param
		 */
		public function __construct($param) {
			if (is_array($param)) {		// an array of property values was supplied
				isset($param['name']) ? $this->name = $param['name'] : '';
				isset($param['value']) ? $this->value = $param['value'] : '';
				isset($param['id']) ? $this->id = $param['id'] : '';
			}
			
			echo 'Setting contstructed:';
			print_r($this);
		}
		
		
		
		/**
		 * RETURNS ALL SETTING OBJECTS FROM THE DATABASE AS AN ARRAY
		 * @return Post[] on success
		 * @return PDOException message on failure
		 */
		public static function all() {
			$list = [];
			$db = Db::getInstance();		// connect to database
			
			// query database
			try {
				$r = $db->query('SELECT * FROM settings');

				// loop through query results to get the property values for each Setting object that will be created
				foreach($r->fetchAll() as $setting) {
					$params = array('id'		=> $setting['id'],
									'name'		=> $setting['name'],
									'value'		=> $setting['value']
					);
						
					// create the Slide object and add it to the array of results to return
					$list[] = new Setting($params);
					
				}
			} catch (PDOException $e) {
				return $e->getMessage();	// something went wrong, return the error
			}
			
			$db = null;		// disconnect from database
			
			return $list;
		}
		
		
		
		/**
		 * RETRIEVES A SINGLE SETTING FROM THE DATABASE
		 * @param integer $id
		 * @return Setting
		 */
		public static function find($id) {
			$db = Db::getInstance();		// connect to database
			$id = intval($id);			// validate input
		
			// query database
			try {
				$req = $db->prepare('SELECT * FROM settings WHERE id = :id');
				$req->execute(array('id' => $id));
				$setting = $req->fetch();
			} catch (PDOException $e) {
				return $e->getMessage();
			}
		
			$db = null;		// disconnect from database
		
			return new Setting(array('id'		=> $setting['id'],
									 'name'		=> $setting['name'],
									 'value'	=> $setting['value']));
		}
	}
?>