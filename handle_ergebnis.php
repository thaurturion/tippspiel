<?php

//Verbindung zur DB aufbauen  (Schritt 2)
$mysqli = new mysqli('localhost', 'root', '', 'tippspiel');

//Verbindungsaufbau ok?
if ($mysqli -> error) {
	//...nein!
	echo('Fehler beim Verbindungsaufbau (' . $mysqli -> errno . '): ' . $mysqli -> error);
} else {
	//...ja!
	//SQL-Anweisung formlieren  (Schritt 3)
	$allgames = "SELECT g.id as id FROM game g";

	$sql = "insert into game (ID, scoreA, scoreB) values ('" . $row['id'] . "', '" . $_POST['id'.'a'.''] . "', '" . $_POST['email'] . "')";

	if ($result = $mysqli -> query($allgames)) {
		//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)

		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {

			//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
			if ($mysqli -> query($sql) === TRUE) {
				echo "Datensatz erfolgreich eingefügt";
			} else {
				echo "Kein Datensatz eingefügt";
			}
		}
		$result -> close();
	} else {
		//Fehler beim Absetzen der SQL-Anweisung
		echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
	}

}
$mysqli -> close();
?>

