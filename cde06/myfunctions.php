<?php

	function erhoeheSeitenzaehler($seitenname) {
		//Verbindung zur DB aufbauen  (Schritt 2)
		$mysqli = new mysqli('localhost', 'root', '', 'meinedb');

		//Verbindungsaufbau ok?
		if ($mysqli->error) {
			//...nein!
			echo ('Fehler beim Verbindungsaufbau (' . $mysqli->errno . '): ' . $mysqli->error);
		} else {
			//...ja!
			//SQL-Anweisung formlieren  (Schritt 3)
			$sql = "insert into statistik (seitenname, zaehler) VALUES ('" . $seitenname . "',1) ON DUPLICATE KEY UPDATE zaehler=zaehler+1";
			//SQL-Anweisung absetzen
			if ($mysqli->query($sql) === TRUE) {
				//echo "Datensatz erfolgreich aktualisiert";
			} else {
				//echo "Kein Datensatz aktualisiert";
			}
		}
		$mysqli->close();
	}	


?>