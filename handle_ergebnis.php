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
	$allgames = "SELECT id, teamA, teamB FROM game";
	
	$mysqli -> query("UPDATE team SET points = NULL, scored = NULL, received = NULL");

	if ($result = $mysqli -> query($allgames)) {
		//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
		
		
		
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			$ida = $row['id'] . 'a';
			$idb = $row['id'] . 'b';
			$scoreA = $_POST[$ida];
			$scoreB = $_POST[$idb];

			$sql = "UPDATE game g SET g.scoreA = " . $scoreA . ", g.scoreB = " . $scoreB . " WHERE g.ID = " . $row['id'];
			//SQL-Anweisung absetzen und Ergebnistabelle in $result merken

			if ($mysqli -> query($sql) === TRUE) {
				echo "Datensatz erfolgreich eingefügt";
				$mysqli -> query("UPDATE team t SET t.scored = coalesce(scored + ".$scoreA.",scored,".$scoreA."), t.received =  coalesce(received + ".$scoreB.",received,".$scoreB.") WHERE id = ".$row['teamA']);
				$mysqli -> query("UPDATE team t SET t.scored = coalesce(scored + ".$scoreB.",scored,".$scoreB."), t.received =  coalesce(received + ".$scoreA.",received,".$scoreA.") WHERE id = ".$row['teamB']);
				
				
				if($_POST[$ida] > $_POST[$idb]) {
					$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 3,points,3) WHERE id = ".$row['teamA']);
					$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 0,points,0) WHERE id = ".$row['teamB']);
					echo "TeamA gewinnt";
				} else if ($_POST[$idb] > $_POST[$ida]) {
					$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 0,points,0) WHERE id = ".$row['teamA']);
					$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 3,points,3) WHERE id = ".$row['teamB']);
					echo "TeamB gewinnt";
				} else {
					$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 1,points,1) WHERE id = ".$row['teamA']);	
					$mysqli -> query("UPDATE team t SET t.points = coalesce(points + 1,points,1) WHERE id = ".$row['teamB']);
					echo "Niemand gewinnt";
				}
				
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

