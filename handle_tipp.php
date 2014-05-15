<?php

	session_start();
	
	//TODO: Kontrolle, ob das Datum inwzischen ungültig ist
	//TODO: tipp eintragen, falls es noch keinen Tipp von diesem User zu diesem Spiel gibt
	//TODO: Tipp updaten, falls es bereits einen Tipp dazu gibt
	
	$gameID = $_POST['gameID'];
	$tippID = $_POST['tippID'];

	if(isset($_POST[$gameID.'a']) && !empty($_POST[$gameID.'a'])
		&& isset($_POST[$gameID.'b'])  && !empty($_POST[$gameID.'b'])) {
		
	$ida = $_POST[$gameID.'a'];
	$idb = $_POST[$gameID.'b'];
	//Verbindung zur DB aufbauen  (Schritt 2)
	$mysqli = new mysqli('localhost', 'root', '', 'tippspiel');
	
	//Verbindungsaufbau ok?
	if ($mysqli -> error) {
		//...nein!
		echo('Fehler beim Verbindungsaufbau (' . $mysqli -> errno . '): ' . $mysqli -> error);
	} else {
		if ($tippID != NULL) {
			$sql = "UPDATE tipp SET tippScoreA = " . $_POST[$gameID.'a'] . ", tippScoreB = " . $_POST[$gameID.'b'] .
			 " WHERE game_ID = " .$gameID." AND user_ID =". $_SESSION["userid"] ." AND id=".$tippID;
		} else if($tippID == NULL AND $_POST[$gameID.'a'] != '' AND $_POST[$gameID.'b'] != ''){
			$sql = "INSERT INTO tipp (game_ID, user_ID, tippScoreA, tippScoreB) 
			values (" . $gameID . ", ".$_SESSION["userid"].", " . $ida . ", " . $idb . ")";
		}
		else {
			echo "Bitte erst eine vollständige eingabe durchführen";
		}
		
		//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
		if ($mysqli -> query($sql) === TRUE) {
			echo "Tippeingabe erfolgreich.";			
		} else {
			//Fehler beim Absetzen der SQL-Anweisung
			echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
		}
		$mysqli->close();	
	}
		} else {
			echo "Ung&uuml;ltige Eingabe";
		}
?>