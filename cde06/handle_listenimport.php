<?php

	if(isset($_POST['fn']) && !empty($_POST['fn'])){
	
		$dateiname = $_POST['fn'];
	
		//Verbindung zur DB aufbauen  (Schritt 2)
		$mysqli = new mysqli('localhost', 'root', '', 'meinedb');

		//Verbindungsaufbau ok?
		if ($mysqli->error) {
			//...nein!
			echo ('Fehler beim Verbindungsaufbau (' . $mysqli->errno . '): ' . $mysqli->error);
		} else {
		
			//Datei zum Lesen öffnen
			$datei = fopen($dateiname, 'r');
			
			//Solange das Dateiende nicht erreicht, wiederhole...
			while(!feof($datei)){
				//liest die nächste Zeile und speichert deren Inhalt in der Variablen $zeile
				$zeile = fgets($datei);
				//die Zeichenkette '$zeile' wird in das Array '$tokens' gewandelt, als Trennzeichen dient das Komma
				$tokens = explode(',', $zeile);
				//beinhaltet das eben erzeugte Array '$tokens' 2 Element (Name, Passwort)?
				if(sizeof($tokens) >= 2){
					//JA! --> alles ok, Name und Passwort in Variablen speichern
					$name = $tokens[0];
					$pwd = $tokens[1];
						
					$sql = "insert into logindaten (name, pwd) values ('$name', '$pwd')";
					if ($mysqli->query($sql) === TRUE) {
						echo "Datensatz erfolgreich eingefügt";
					} else {
						echo "Kein Datensatz eingefügt: " . $mysqli->error;
					}
						
				} else {
					echo "Fehler beim Einfügen des Datensatzes ($zeile)<br>ROLLBACK ausgeführt!";
					break;
				}
			}
			
			fclose($datei);
			
			$mysqli->close();
			
		}
		
	} else {
		echo "Kein Dateiname verfügbar!";
	}

?>
