<?php
class LogMessage {

  private $severity;
  private $message;

  public function  __construct($severity, $message){
	$this->severity = $severity;
	$this->message = $message;
  }
  
  public function getSeverity(){
	return $this->severity;
  }
  
  public function getMessage(){
	return $this->message;
  }
  
  public function __toString() {
        return $this->message . " (" . $this->severity . ")" ;
  }
  
}
?>
