<?php
	class Setting {
		// define the attributes stored in the database (columns)
		// they are public so that we can access them using $setting->attribute directly
		public $id;
		public $name;
		public $value;
		public $type;
		public $tooltip;
		public $image;
		
		
		/**
		 * CREATES A NEW SETTING OBJECT GIVEN THE NAME, VALUE AND TYPE
		 * @param array $array
		 */
		public function __construct($arr) {
				if (isset($arr['id'])) $this->id = $arr['id'];
				if (isset($arr['tooltip'])) $this->tooltip = $arr['tooltip'];
				if (isset($arr['image'])) $this->image = $arr['image'];
				$this->name = $arr['name'];
				$this->value = $arr['value'];
				$this->type = $arr['type'];
		}
		
		
		
		/**
		 * RETURNS ALL SETTING OBJECTS FROM THE DATABASE AS AN ARRAY
		 * @return an array of Setting objects on success
		 * @return PDOException message on failure
		 */
		public static function all() {
			$settings = array();
			
			try {
				$db = Db::getInstance();		// connect to database
				$r = $db->query('SELECT * FROM settings');

				// loop through query results to get the property values for each Setting object that will be created
				foreach($r->fetchAll() as $setting) {
					$params = array();
					foreach ($setting as $key => $value) {
						$params[$key] = $value;
					}

					$settings[] = new Setting($params);
				}
			} catch (PDOException $e) {
				return $e->getMessage();	// something went wrong, return the error
			}
			
			$db = null;		// disconnect from database
			
			return $settings;
		}
		
		
		
		/**
		 * RETRIEVES A SINGLE SETTING FROM THE DATABASE
		 * @param integer $id
		 * @return a single Setting object on success
		 */
		public static function find($id) {
			$params = array();
		
			try {
				$db = Db::getInstance();
				$r = $db->prepare('SELECT * FROM `settings` WHERE `id` = :id');
				$r->execute(array('id' => $id));
				$setting = $r->fetch();
			} catch (PDOException $e) {
				return $e->getMessage();		// something went wrong, return the mysql error
			}
		
			$db = null;		// disconnect from database

			foreach ($setting as $key => $value) {
				$params[$key] = $value;
			}
		
			return new Setting($params);
		}
		
		
		/**
		 * PROCESS THE SUBMISSION OF THE edit() FORM AND UPDATE THE DATABASE RECORD
		 * @return 1 on success
		 * @return Exception message on failure
		 */
		public function update() {
			try {
				$db = Db::getInstance();
				$r = $db->prepare("UPDATE `settings` SET `value`='$this->value' WHERE `id` = :id");
				$r->execute(array('id' => $this->id));
			} catch (PDOException $e) {
				return $e->getMessage();		// something went wrong, return the mysql error
			}
			
			$db = null;		// disconnect from database
			return 1;
		}
	}
?>