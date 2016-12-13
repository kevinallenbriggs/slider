<?php
	class Setting {
		// define the attributes stored in the database (columns)
		// they are public so that we can access them using $setting->attribute directly
		public $id;
		public $name;
		public $value;
		public $type;
		
		
		/**
		 * CREATES A NEW SETTING OBJECT GIVEN THE NAME, VALUE AND TYPE
		 * @param array $array
		 */
		public function __construct($arr) {
			if (is_array($arr)) {		// an array of property values was supplied
				if (isset($arr['name']) && isset($arr['value']) && isset($arr['type'])) {
					if (isset($arr['id'])) {
						$this->id = $arr['id'];		// if the id was provided (such as from the all() function, set the id of the object)
					}
					$this->name = $arr['name'];
					$this->value = $arr['value'];
					$this->type = $arr['type'];
				}
			}
		}
		
		
		
		/**
		 * RETURNS ALL SETTING OBJECTS FROM THE DATABASE AS AN ARRAY
		 * @return an array of Setting objects on success
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
									'value'		=> $setting['value'],
									'type'		=> $setting['type']);
						
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
		 * @return a single Setting object on success
		 */
		public static function find($id) {
			$db = Db::getInstance();		// connect to database
			$id = intval($id);			// validate input
		
			// query database
			try {
				$r = $db->prepare('SELECT * FROM `settings` WHERE `id` = :id');
				$r->execute(array('id' => $id));
				$setting = $r->fetch();
			} catch (PDOException $e) {
				return $e->getMessage();		// something went wrong, return the mysql error
			}
		
			$db = null;		// disconnect from database
		
			return new Setting(array('id'		=> $setting['id'],
									 'name'		=> $setting['name'],
									 'value'	=> $setting['value'],
									 'type'		=> $setting['type']));
		}
		
		
		/**
		 * UPDATES A SINGLE SETTING IN THE DATABASE
		 * @param string $setting_value
		 * @return the updated Setting object on success
		 * @return PDOException message on failure
		 */
		public function update($setting_value) {
			$db = Db::getInstance();		// connect to database
			$str = strval($setting_value);		// sanitize setting value
			$id = intval($_GET['id']);			// sanitize setting ID from URI
			
			// query database
			try {
				$r = $db->prepare("UPDATE `settings` SET `value`='$str' WHERE `id` = :id");
				if ($r->execute(array('id' => $id))) $this->value = $str;
			} catch (PDOException $e) {
				return $e->getMessage();		// something went wrong, return the mysql error
			}
			
			$db = null;		// disconnect from database
			return $this->find($id);
		}
	}
?>