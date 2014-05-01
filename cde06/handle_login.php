<?php
	session_start();
	
	require_once('LogMessage.class.php');
	require_once('LogUtil.class.php');

	//POST-Parameter überprüfen (Schritt 1)
	if(   isset($_POST['name']) && !empty($_POST['name'])
	   && isset($_POST['pwd']) && !empty($_POST['pwd'])){
	   
		$ok = false;
	
		//Verbindung zur DB aufbauen  (Schritt 2)
		$mysqli = new mysqli('localhost', 'root', '', 'meinedb');

		//Verbindungsaufbau ok?
		if ($mysqli->error) {
			//...nein!
			echo ('Fehler beim Verbindungsaufbau (' . $mysqli->errno . '): ' . $mysqli->error);
		} else {
			//...ja!
			//SQL-Anweisung formlieren  (Schritt 3)
			$sql = "select pwd from logindaten where name='" . $_POST['name'] . "'";
			//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
			if ($result = $mysqli->query($sql)) {
				//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
				if($row = $result->fetch_array(MYSQLI_ASSOC)){
					//Spalte "pwd" der ersten Zeile gleich übergebenes Kennwort?
					if($row['pwd'] == $_POST['pwd']){
						//...ja! --> Login ok – alles gut!
						$ok = true;
						$m = new LogMessage(20, $_POST['name'] . ' hat sich angemeldet');
						if(!LogUtil::log($m)){
							echo "Logging-Fehler";
						}
					} else {
						$m = new LogMessage(20, $_POST['name'] . ' konnte nicht angemeldet werden (' . $_POST['pwd'] . ')');
						if(!LogUtil::log($m)){
							echo "Logging-Fehler";
						}
					}
				} else {
					//Kein Datensatz vorhanden! (keine erste Zeile der Ergebnistabelle)
					echo "Keinen Eintrag zum Namen '" . $_POST['name'] . "' gefunden";
				}
				$result->close();
			} else {
				//Fehler beim Absetzen der SQL-Anweisung
				echo ('Fehler beim Senden der SQL-Anweisung (' . $mysqli->errno . '): ' . $mysqli->error);
			}
		}
		$mysqli->close();
		
		//Login ok? Ausgabe!
		if($ok){
			//...ja!
			$_SESSION["login"] = 1;
			echo "<h2>Login akzeptiert</h2>";
		} else {
			//...nein!
			$_SESSION["login"] = 0;
			echo "<h1>Login nicht akzeptiert</h2>";
		}
		
	} else {
		//POST-Parameter sind teilweise gar nicht vorhanden oder leer!
		echo "Ungültige Daten";
	}
?>
