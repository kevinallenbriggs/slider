<?php
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $database	=	'slider';
        $username	=	'slider';
        $password	=	'nFTsX8GjQzYbKV6a';
        self::$instance = new PDO("mysql:host=localhost;dbname=$database", $username, $password, $pdo_options);
      }
      return self::$instance;
    }
  }
?>