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
			$sqlMatches = "SELECT g.id id, g.datetime datetime, IFNULL(g.scoreA, 'N/A') sA, IFNULL(g.scoreB, 'N/A') sB, a.team_name ateam, 
				b.team_name bteam, IFNULL(ti.tippScoreA, '') tippScoreA, IFNULL(ti.tippScoreB,'') tippScoreB, ti.ID tippID FROM game g 
				JOIN team a ON g.teamA = a.ID JOIN team b ON g.teamB = b.ID LEFT JOIN tipp ti ON ti.user_ID =" . $_SESSION["userid"] . " AND ti.game_ID = g.id
				WHERE g.spieltag =". $spieltag ."  ORDER BY g.datetime ASC";
			//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
			if ($games = $mysqli -> query($sqlMatches)) {
				//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)

				//Die Tabelle muss über DIVS formatiert werden, da tables nicht mit innenliegenden Formularen klarkommt.
					echo ' <div class="spiele1"> Datum </div> 
					<div class="spiele3"></div>
					<div class="spiele2"> Mannschaft A </div> 
					 <div class="spiele3"> Tipp A </div>
					 <div class="spiele3"></div>
					 <div class="spiele4"> Mannschaft B </div>
					<div class="spiele5"> Tipp B </div>
					<div class="spiele6"> Ergebnis </div>
					<div class="spiele7"> Absenden</div>';

				$count1 = 0;
					while ($row3 = $games -> fetch_array(MYSQLI_ASSOC)) {
						$validDate = strtotime($time) < strtotime($row3['datetime']); //Boolscher Wert, der anzeigt, ob das Spiel bereits stattgefunden hat
						if ($validDate) {
							echo '<form action="#" method="post" id="tipp'.$count1.'" onsubmit="return false">';
						}
						echo '<div class="spiele1">'.$row3['datetime'].'</div><div class="spiele3"><img src="images/flags/'.$row3['ateam'].
						'.png" width="50px height="50px"></div><div class="spiele2">'.$row3['ateam'].'</div>';  //Datum, Flagge und Mannschaft
						 

						//Name Mannschaft A
						echo '<div class="spiele3">';
						if ($validDate) {
							echo '<input type="text" value="' . $row3['tippScoreA'] . '" name="' . $row3['id'] . 'a" size="1">';
							echo '<input type="hidden" value="' . $row3['tippID'] . '" name="tippID" readonly>';
							//tippID
							echo '<input type="hidden" value="' . $row3['id'] . '" name="gameID" readonly>';
							//gameID

						} else {
							echo $row3['tippScoreA'];
							//Tipp für Mannschaft A
						}
						echo '</div><div class="spiele3"><img src="images/flags/'.$row3['bteam'].'.png" width="50px height="50px"></div>
						<div class="spiele4">'.$row3['bteam'].'</div>';
						// Name Mannschaft B
						echo '<div class="spiele5">';
						if ($validDate) {
							echo '<input type="text" value="' . $row3['tippScoreB'] . '" name="' . $row3['id'] . 'b" size="1">';
							// Tipp für Mannschaft B
						} else {
							echo $row3['tippScoreA'];
							//Tipp für Mannschaft B
						}
						echo '</div>';
						echo '<div class="spiele6">'.$row3['sA'] . ':' . $row3['sB'].'</div>';
						// Spielergebnis
						echo '<div class="spiele7">';
						if ($validDate) {
							echo '<input type="button" id="submitbtn'.$count1.'" value="OK!">';
							$count1++;
							echo "</form>";
						}
						echo '</div>';
				}
			}
			$games -> close();
		}
		$mysqli -> close();

		return $success;
	}

}
?>