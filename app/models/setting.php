<?php
	class Setting {
		// define the attributes stored in the database (columns)
		// they are public so that we can access them using $setting->attribute directly
		public $id;
		public $setting;
		public $value;
		
		
		/**
		 * CREATES A NEW SETTING OBJECT THAT REQUIRES BOTH A NAME AND VALUE
		 * @param unknown $param
		 */
		public function __construct($param) {
			if (is_array($param)) {		// an array of property values was supplied
				isset($param['setting']) ? $this->setting = $param['setting'] : '';
				isset($param['value']) ? $this->value = $param['value'] : '';
				isset($param['id']) ? $this->id = $param['id'] : '';
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
									'setting'		=> $setting['setting'],
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
									 'setting'		=> $setting['setting'],
									 'value'	=> $setting['value']));
		}
		
		
		/**
		 * UPDATES A SINGLE SETTING IN THE DATABASE
		 * @param unknown $post_value
		 * @return the updated Setting object on success
		 * @return PDOException message on failure
		 */
		public function update($post_value) {
			$db = Db::getInstance();		// connect to database
			$str = strval($post_value);		// validate input TODO: sanitize input
			$id = intval($_GET['id']);
			
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