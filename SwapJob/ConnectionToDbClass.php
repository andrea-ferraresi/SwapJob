<?php
include_once("LoggerClass.php");

class ConnectionToDbClass{
    private static $connection = null;
    Var $configurationDb;
    Var $LoggerClassInstance;

    public static function getConnection() {
      if(is_null($this->connection)) {
          $this->connection = new ConnectionToDbClass();
      }
      return $this->connection;
    }
	

   
    private function __construct(){
		$this->LoggerClassInstance = LoggerClass::getInstance();
		$this->configurationDb = parse_ini_file('./config/configDb.ini');
 
        $this->connection= mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
		
        if ($this->connection) {
            $messageLog = $_SERVER['PHP_SELF'] . " Successfully connected to db";
            $this->LoggerClassInstance->write($messageLog);
        }
        else {
            $err = mysqli_connect_error();
            $messageLog = $_SERVER['PHP_SELF'] . " " . $err['code'] . $err['message'];
            $this->LoggerClassInstance->write($messageLog);
        }
        
    }
    
    
    
    function closeConnection(){
        //($this->connection);
    }
    
}



?>
