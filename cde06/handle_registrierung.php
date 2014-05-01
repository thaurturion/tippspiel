<?php

if(    isset($_POST['pwd1']) && isset($_POST['pwd1']) 
    && isset($_POST['pwd2']) && !empty($_POST['pwd2'])
    && isset($_POST['name']) && !empty($_POST['name'])
    && isset($_POST['email']) && !empty($_POST['email'])
){
	if($_POST['pwd1'] == $_POST['pwd2']){

		//Verbindung zur DB aufbauen  (Schritt 2)
		$mysqli = new mysqli('localhost', 'root', '', 'meinedb');

		//Verbindungsaufbau ok?
		if ($mysqli->error) {
			//...nein!
			echo ('Fehler beim Verbindungsaufbau (' . $mysqli->errno . '): ' . $mysqli->error);
		} else {
			//...ja!
			//SQL-Anweisung formlieren  (Schritt 3)
			$sql = "insert into logindaten (name, pwd) values ('" . $_POST['name'] . "', '" . $_POST['pwd1'] . "')";
			//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
			if ($mysqli->query($sql) === TRUE) {
					echo "Datensatz erfolgreich eingefügt";
			} else {
				echo "Kein Datensatz eingefügt";
			}
		}
		$mysqli->close();
	
	} else {
		echo "Kennwörter stimmen nicht überein";
	}
	
} else {
	echo "Ungültige Daten";
}

?>

