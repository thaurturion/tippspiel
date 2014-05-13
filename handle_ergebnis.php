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
	$allgames = "SELECT id FROM game";

	if ($result = $mysqli -> query($allgames)) {
		//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)

		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			$ida = $row['id'] . 'a';
			$idb = $row['id'] . 'b';
			echo $_POST[$ida];
			echo $_POST[$idb];

			$sql = "UPDATE game g SET g.scoreA = " . $_POST[$ida] . ", g.scoreB = " . $_POST[$idb] . " WHERE g.ID = " . $row['id'];
			//SQL-Anweisung absetzen und Ergebnistabelle in $result merken

			if ($mysqli -> query($sql) === TRUE) {
				echo "Datensatz erfolgreich eingefügt";
			} else {
				echo "Kein Datensatz eingefügt";
			}
		}
		include 'highscore_neuberechnen.php';		
		$result -> close();
	} else {
		//Fehler beim Absetzen der SQL-Anweisung
		echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
	}

}
$mysqli -> close();
?>

