<?php

//TODO: Auslagerung der SQL Statements an ext. Klassen

//Verbindung zur DB aufbauen  (Schritt 2)
$mysqli = new mysqli('localhost', 'root', '', 'tippspiel');

//Verbindungsaufbau ok?
if ($mysqli -> error) {
	//...nein!
	echo('Fehler beim Verbindungsaufbau (' . $mysqli -> errno . '): ' . $mysqli -> error);
} else {
	//...ja!
	//SQL-Anweisung formlieren  (Schritt 3)
	$allgames = "SELECT id, teamA, teamB, spieltag FROM game";

	$mysqli -> query("UPDATE team SET points = NULL, scored = NULL, received = NULL");
	$mysqli -> query("UPDATE user SET point = 0");
	$mysqli -> query("UPDATE team SET anzSpiele = 0");

	if ($result = $mysqli -> query($allgames)) {
		//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)

		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			$ida = $row['id'] . 'a';
			$idb = $row['id'] . 'b';
			$scoreA = $_POST[$ida];
			$scoreB = $_POST[$idb];

			$sql = "UPDATE game g SET g.scoreA = " . $scoreA . ", g.scoreB = " . $scoreB . " WHERE g.ID =" . $row['id'];
			//SQL-Anweisung absetzen und Ergebnistabelle in $result merken

			//Speichere die Spielergebnisse ab und vergebe Punkte für die Mannschaften
			if ($mysqli -> query($sql) === TRUE) {
				echo "Datensatz erfolgreich eingefügt";

				//Finde raus, ob das Spiel nach der Gruppenphase stattfindet
				if ($row['spieltag'] <= 3) {

					//Erhöhe Tore  und Anzahl Spiele der beiden Mannschaften
					$mysqli -> query("UPDATE team t SET t.scored = coalesce(scored + " . $scoreA . ",scored," . $scoreA . "), 
				t.received =  coalesce(received + " . $scoreB . ",received," . $scoreB . "), 
				t.anzSpiele = coalesce(anzSpiele + " . 1 . ",anzSpiele," . 1 . ") 
				WHERE id = " . $row['teamA']);
					$mysqli -> query("UPDATE team t SET t.scored = coalesce(scored + " . $scoreB . ",scored," . $scoreB . "), 
				t.received =  coalesce(received + " . $scoreA . ",received," . $scoreA . "),
				t.anzSpiele = coalesce(anzSpiele + " . 1 . ",anzSpiele," . 1 . ") 
				WHERE id = " . $row['teamB']);

					//Erhöhe Punkte der Mannschaften
					if ($_POST[$ida] > $_POST[$idb]) {
						$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 3,points,3) WHERE id = " . $row['teamA']);
						$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 0,points,0) WHERE id = " . $row['teamB']);
						echo "TeamA gewinnt";
					} else if ($_POST[$idb] > $_POST[$ida]) {
						$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 0,points,0) WHERE id = " . $row['teamA']);
						$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 3,points,3) WHERE id = " . $row['teamB']);
						echo "TeamB gewinnt";
					} else {
						$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 1,points,1) WHERE id = " . $row['teamA']);
						$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 1,points,1) WHERE id = " . $row['teamB']);
						echo "Niemand gewinnt";
					}
				}

			} else {
				echo "Kein Datensatz eingefügt";
			}

			$selectedTipp = "SELECT t.id, t.tippScoreA, t.tippScoreB, u.ID uID FROM tipp t JOIN user u ON t.user_ID = u.ID";

			//Set Highscore for Players
			if ($res = $mysqli -> query($selectedTipp)) {
				while ($row4 = $res -> fetch_array(MYSQLI_ASSOC)) {

					if ($scoreA == $row4['tippScoreA'] && $scoreB == $row4['tippScoreB']) {
						$mysqli -> query("UPDATE user SET point = point + 3 WHERE id = " . $row4['uID']);

					} else if ($scoreA - $scoreB == $row4['tippScoreA'] - $row4['tippScoreB']) {
						$mysqli -> query("UPDATE user SET point = point + 2 WHERE id = " . $row4['uID']);

					} else if (($scoreA < $scoreB AND $row4['tippScoreA'] < $row4['tippScoreB']) OR ($scoreA > $scoreB AND $row4['tippScoreA'] > $row4['tippScoreB']) OR ($scoreA == $scoreB AND $row4['tippScoreA'] == $row4['tippScoreB'])) {

						$mysqli -> query("UPDATE user SET point =  point + 1 WHERE id = " . $row4['uID']);
					}
				}

			} else {
				echo "You fucked it up!";
			}

			$res -> close();
			echo '<script type="text/javascript">loadNavi();</script>';

		}
		$result -> close();
	} else {
		//Fehler beim Absetzen der SQL-Anweisung
		echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
	}

}
$mysqli -> close();
?>

