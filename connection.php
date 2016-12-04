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
        $port     = 8889;
        $username	=	'slider';
        $password	=	'oUQtr3QnNYIotiBB';
        
        // create the new singleton instance (connection to database)
        self::$instance = new PDO("mysql:host=127.0.0.1;dbname=$database;port=$port", $username, $password, $pdo_options);
      }
      
      return self::$instance;
    }
  }
?>