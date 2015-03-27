
<?php
include_once("./config/configurationForClasses.php");

class LoggerClass{
  private static $instance = null;
  Var $fullLogPath;
  
  
 
  public static function getInstance() {
      if(is_null($this->instance)) {
          $this->instance = new LoggerClass();
      }
      return $this->instance;
  }
 

  private function __construct(){
    if(!file_exists(log_dir)){
        mkdir(log_dir);
    }
    $this->fullLogPath = logDir . "//" . logFileName;
    $this->instance = fopen($this->fullLogPath,'a');
    if(!is_resource($this->instance)) {
        $errmsg = "Log error: Unable to open file: $this->FullLogPath \n" . "Suggestion: Check file path and folder permissions.\n";
        echo $errmsg;
        $this->endlog();
        die("Can't open file");
    }
    
    
    
    
    
  }


  
  function write($logtext) {
    $today = getdate();
    $logtext = $today["mday"]. "-" . $today["mon"]. "-" . $today["year"]. " at " . $today["hours"] . ":" . $today["minutes"]. ":" . $today["seconds"] . "  file: " . $logtext;
    if(fwrite($this->instance,$logtext . " \r\n")===false) {
    #if(@fwrite($this->instance,$logtext)===false) {
          // write faled issue error
          $errmsg = "Log error: Unable to write to file: {$this->FullLogPath}\n"."Suggestion: Check file path and folder permissions.\n";
          echo $errmsg;
          $this->endlog();
        }
    }
  }

  function closeLogFile(){
    if($this->instance){
      //@fclose($this->instance);
      if( fclose($this->instance) ){
        $this->instance = null;
      }
      else
        die("Error in endLog()");
    }
  }


?>