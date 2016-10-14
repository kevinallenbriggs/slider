<?php
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
      	
      	// set the connection options which will apply to the entire app
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $pdo_options[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_ASSOC;
        $pdo_options[PDO::ATTR_EMULATE_PREPARES] = false;
        
        // database credentials
        $database	=	'slider';
        $username	=	'slider';
        $password	=	'nFTsX8GjQzYbKV6a';
        
        // create the new singleton instance (connection to database)
        self::$instance = new PDO("mysql:host=localhost;dbname=$database", $username, $password, $pdo_options);
      }
      
      return self::$instance;
    }
  }
?>