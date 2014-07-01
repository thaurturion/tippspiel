<?php
class knockout {

	public static function log($spieltag) {
		$success = false;

		//Verbindung zur DB aufbauen  (Schritt 2)
		$mysqli = new mysqli('localhost', 'root', '', 'tippspiel');

		//Verbindungsaufbau ok?
		if ($mysqli -> error) {
			//...nein!
			echo('Fehler beim Verbindungsaufbau (' . $mysqli -> errno . '): ' . $mysqli -> error);
		} else {
			$time = date("Y-m-d H:i:s", time());
			$sqlMatches = "SELECT g.id id, g.datetime datetime, g.scoreA sA, g.scoreB sB, a.team_name ateam, 
				b.team_name bteam, IFNULL(ti.tippScoreA, '') tippScoreA, IFNULL(ti.tippScoreB,'') tippScoreB, ti.ID tippID FROM game g 
				JOIN team a ON g.teamA = a.ID JOIN team b ON g.teamB = b.ID LEFT JOIN tipp ti ON ti.user_ID =" . $_SESSION["userid"] . " AND ti.game_ID = g.id
				WHERE g.spieltag =". $spieltag ."  ORDER BY g.datetime ASC";
			//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
			if ($games = $mysqli -> query($sqlMatches)) {
				//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)

				echo "<div>
					Datum
					Mannschaft A
					Tipp A
					Mannschaft B
					Tipp B
					Ergebnis
					Absenden
					</div><br>";

				$count1 = 0;
				while ($row3 = $games -> fetch_array(MYSQLI_ASSOC)) {
					$validDate = strtotime($time) < strtotime($row3['datetime']);
					if ($validDate) {
						echo '<form action="#" method="post" id="tipp' . $count1 . '" onsubmit="return false">';
					}
					echo $row3['datetime'] . //Datum
					'<img src="images/flags/'.$row3['ateam'].'.png" width="50px height="50px">'.$row3['ateam'];

					//Name Mannschaft A
					if ($validDate) {
						echo '<input type="text" value="' . $row3['tippScoreA'] . '" name="' . $row3['id'] . 'a" size="1">';
						echo '<input type="hidden" value="' . $row3['tippID'] . '" name="tippID">';
						//tippID
						echo '<input type="hidden" value="' . $row3['id'] . '" name="gameID">';
						//gameID

					} else {
						echo $row3['tippScoreA'];
						//Tipp für Mannschaft A
					}
					echo '<img src="images/flags/'.$row3['bteam'].'.png" width="50px height="50px">'.$row3['bteam'];
					// Name Mannschaft B
					if ($validDate) {
						echo '<input type="text" value="' . $row3['tippScoreB'] . '" name="' . $row3['id'] . 'b" size="1">';
						// Tipp für Mannschaft B
					} else {
						echo $row3['tippScoreA'];
						//Tipp für Mannschaft B
					}
					echo $row3['sA'] . ':' . $row3['sB'];
					// Spielergebnis
					if ($validDate) {
						echo '<input type="button" id="submitbtn' . $count1 . '" value="Best&auml;tigen">';
						$count1++;
					}
					//Bestätigen der Eingabe
					echo "</form>";
				}
			}
			$games -> close();
		}
		$mysqli -> close();

		return $success;
	}

}
?>