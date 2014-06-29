<?php

//Verbindung zur DB aufbauen  (Schritt 2)
$mysqli = new mysqli('localhost', 'root', '', 'tippspiel');

//Verbindungsaufbau ok?
if ($mysqli -> error) {
	//...nein!
	echo('Fehler beim Verbindungsaufbau (' . $mysqli -> errno . '): ' . $mysqli -> error);
} else {
	
	//SQL Anweisung, die alle Spiele ausgibt
	$allgames = "SELECT id, teamA, teamB, spieltag FROM game";
	
	
	//Resetten der Punkte der Spieler und der Mannschaften sowie der gespielten Spiele, damit diese nach Bestätigung der Ergebniseingabe neuberechnet werden können
	$mysqli -> query("UPDATE team SET points = NULL, scored = NULL, received = NULL, anzSpiele = 0");
	$mysqli -> query("UPDATE user SET point = 0");

	if ($result = $mysqli -> query($allgames)) {
		//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)

		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
				
			//Umwandlung der SpielID in eine Variable, die die SpielID und ein Suffix enthält
			$ida = $row['id'] . 'a';
			$idb = $row['id'] . 'b';
			
			//Spielergebnis, das mit der Hilfsvariable ausgelesen wird
			$scoreA = $_POST[$ida];
			$scoreB = $_POST[$idb];

			//SQL Statement zum Aktualisieren der Spielergebnisse
			$sql = "UPDATE game g SET g.scoreA = " . $scoreA . ", g.scoreB = " . $scoreB . " WHERE g.ID =" . $row['id'];

			//Speichere die Spielergebnisse ab und vergebe Punkte für die Mannschaften
			if ($mysqli -> query($sql) === TRUE) {
				
				//Finde raus, ob das Spiel nach der Gruppenphase stattfindet, dann erhöhe Punkte für Tabellen der Gruppenphasen.
				if ($row['spieltag'] <= 3) {

					//Erhöhe Tore  und Anzahl Spiele der beiden Mannschaften
					//TEAM A
					$mysqli -> query("UPDATE team t SET t.scored = coalesce(scored + " . $scoreA . ",scored," . $scoreA . "), 
										t.received =  coalesce(received + " . $scoreB . ",received," . $scoreB . "), 
										t.anzSpiele = coalesce(anzSpiele + " . 1 . ",anzSpiele," . 1 . ") 
										WHERE id = " . $row['teamA']);
					//TEAM B
					$mysqli -> query("UPDATE team t SET t.scored = coalesce(scored + " . $scoreB . ",scored," . $scoreB . "), 
										t.received =  coalesce(received + " . $scoreA . ",received," . $scoreA . "),
										t.anzSpiele = coalesce(anzSpiele + " . 1 . ",anzSpiele," . 1 . ") 
										WHERE id = " . $row['teamB']);

					//Erhöhe Punkte der Mannschaften
					
					
					if ($_POST[$ida] > $_POST[$idb]) {
						//Sieg für Team A	
						$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 3,points,3) WHERE id = " . $row['teamA']);
						$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 0,points,0) WHERE id = " . $row['teamB']);
						echo "TeamA gewinnt";
					} else if ($_POST[$idb] > $_POST[$ida]) {
						//Sieg für Team B	
						$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 0,points,0) WHERE id = " . $row['teamA']);
						$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 3,points,3) WHERE id = " . $row['teamB']);
						echo "TeamB gewinnt";
					} else {
						//Unentschieden	
						$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 1,points,1) WHERE id = " . $row['teamA']);
						$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 1,points,1) WHERE id = " . $row['teamB']);
						echo "Niemand gewinnt";
					}
				}
				//Bei KO-Runden Spielen werden keine Informationen diesbezüglich eingetragen.
				

			} else {
				echo "Fehler beim Eintragen.";
			}

				
			//Wähle alle Tipps der der User aus
			$selectedTipp = "SELECT t.id, t.tippScoreA, t.tippScoreB, u.ID uID FROM tipp t JOIN user u ON t.user_ID = u.ID WHERE t.game_ID = ${row['id']}";

			//Setzen der Highscores der Spieler
			if ($res = $mysqli -> query($selectedTipp)) {
				while ($row4 = $res -> fetch_array(MYSQLI_ASSOC)) {
					
					if ($scoreA == $row4['tippScoreA'] && $scoreB == $row4['tippScoreB']) {
						//Wenn die Tore für Mannschaft A und für Mannschaft B genauso getippt wurden wie gespielt, dann belohne den Spieler mit 3 Punkten	
						$mysqli -> query("UPDATE user SET point = point + 3 WHERE id = " . $row4['uID']);
						echo "<script type='text/javascipt'>alert('Spieler'".$row4['uID']."erhält 3 Punkte');</script>";
					} else if ($scoreA - $scoreB == $row4['tippScoreA'] - $row4['tippScoreB']) {
						//Wenn die Tore für Mannschaft A und für Mannschaft B genauso abweichen, dann belohne den Spieler mit 2 Punkten
						$mysqli -> query("UPDATE user SET point = point + 2 WHERE id = " . $row4['uID']);

					} else if (($scoreA < $scoreB AND $row4['tippScoreA'] < $row4['tippScoreB']) OR ($scoreA > $scoreB AND $row4['tippScoreA'] > $row4['tippScoreB']) OR 
								($scoreA == $scoreB AND $row4['tippScoreA'] == $row4['tippScoreB'])) {
						//Wenn der Spieler korrekterweise auf Sieg/Unentschieden/Niederlage getippt hat, belohne ihn mit 1 Punkt
						$mysqli -> query("UPDATE user SET point =  point + 1 WHERE id = " . $row4['uID']);
					}
				}

			} else {
				echo "You fucked it up!";
			}

			$res -> close();
			
		}
		$result -> close();
	} else {
		//Fehler beim Absetzen der SQL-Anweisung
		echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
	}

}
$mysqli -> close();
?>

