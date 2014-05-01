<?php

require_once('LogMessage.class.php');

class LogUtil {

	public static function log($lm){
		$success = false;
	
		//Verbindung zur DB aufbauen  (Schritt 2)
		$mysqli = new mysqli('localhost', 'root', '', 'meinedb');

		//Verbindungsaufbau ok?
		if ($mysqli->error) {
			//...nein!
			echo ('Fehler beim Verbindungsaufbau (' . $mysqli->errno . '): ' . $mysqli->error);
		} else {
			//...ja!
			//SQL-Anweisung formlieren  (Schritt 3)
			$sql = "insert into log (time, severity, message) values (now(), " . $lm->getSeverity() . ", '" . $mysqli->real_escape_string($lm->getMessage()) . "')";
			//SQL-Anweisung absetzen
			if ($mysqli->query($sql) === TRUE) {
				$success = true;
			}
		}
		$mysqli->close();	  
		
		return $success;
	}

}

?>