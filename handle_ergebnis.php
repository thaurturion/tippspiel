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
	$sql = "insert into user (username, password, email, admin, point) values ('" . $_POST['name'] . "', '" . $_POST['pwd1'] . "', '" . $_POST['email'] . "', 0, 0)";
	//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
	if ($mysqli -> query($sql) === TRUE) {
		echo "Datensatz erfolgreich eingefügt";
	} else {
		echo "Kein Datensatz eingefügt";
	}
}
$mysqli -> close();
?>

