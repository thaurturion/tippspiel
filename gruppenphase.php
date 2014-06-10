<?php
session_start();
?>

<script type="text/javascript">
	
	jQuery(function(){
		for(var i = 0; i < document.aob.amountOfButtons.value; i++) {
			doAjax(i);
		}
		$('#tabs').tabs();
	});
	
	function doAjax(i) {
		jQuery('#submitbtn'+i).click(function(){
				jQuery.post(
					'handle_tipp.php?',
					jQuery('#tipp'+i).serialize(),
					function(data){
						jQuery('#content').empty();
						jQuery('#content').append(data);
						jQuery('#content').load('gruppenphase.php');
					},
					'html'
				);
			});
	}
</script>

<h1>Willkommen beim WM Tippspiel</h1>
<div id="tabs">
	<ul>
	<?php
	//Verbindung zur DB aufbauen  (Schritt 2)
	$mysqli = new mysqli('localhost', 'root', '', 'tippspiel');

	//Verbindungsaufbau ok?
	if ($mysqli -> error) {
		//...nein!
		echo('Fehler beim Verbindungsaufbau (' . $mysqli -> errno . '): ' . $mysqli -> error);
	} else {
		
		//Bestimme Anzahl der Button, die mittels JS erzeugt werden sollen und übermittle sie mittels Formular
		//TODO: evtl. lieber direkt über die URL senden.
		$amountOfButtons = $mysqli -> query("SELECT DISTINCT COUNT(ID) id FROM game WHERE spieltag <= 3");
		while($row = $amountOfButtons -> fetch_array(MYSQLI_ASSOC)) {
			echo '<form name ="aob">';
			echo '<input type="hidden" name="amountOfButtons" value="'.$row['id'].'" readonly>';
			echo '</form>';
		}
        

		$sql = "SELECT DISTINCT t.group FROM team t ORDER BY t.group ASC";
		//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
		if ($result = $mysqli -> query($sql)) {
			//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
			while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
				echo '<li>';
				echo '<td><a href="#gruppe' . strtoupper($row['group']) . '">Gruppe' . strtoupper($row['group']) . '</a>';
				echo "</li>";
			}
			echo "</ul>";
			$result -> close();
		} else {
			//Fehler beim Absetzen der SQL-Anweisung
			echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
		}

		if ($result = $mysqli -> query($sql)) {
			//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
			while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
				echo '<div id="gruppe' . strtoupper($row['group']) . '">';

				$group = $row['group'];

				echo "<h1>Spiele</h1>";
				$time = date("Y-m-d H:i:s", time());
				//...ja!
				//SQL-Anweisung formlieren  (Schritt 3)

				$sqlMatches = "SELECT g.id id, g.datetime datetime, g.scoreA sA, g.scoreB sB, a.team_name ateam, 
				b.team_name bteam, IFNULL(ti.tippScoreA, '') tippScoreA, IFNULL(ti.tippScoreB,'') tippScoreB, ti.ID tippID FROM game g 
				JOIN team a ON g.teamA = a.ID JOIN team b ON g.teamB = b.ID LEFT JOIN tipp ti ON ti.user_ID =" . $_SESSION["userid"] . " AND ti.game_ID = g.id
				WHERE a.group LIKE '" . $group . "' AND b.group LIKE '" . $group . "'  AND g.spieltag <= 3 ORDER BY g.datetime ASC";
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
							echo '<form action="#" method="post" id="tipp'.$count1.'" onsubmit="return false">';
						}
						echo $row3['datetime'] . //Datum
						 $row3['ateam'];

						//Name Mannschaft A
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
						echo $row3['bteam'];
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
							echo '<input type="button" id="submitbtn'.$count1.'" value="Best&auml;tigen">';
							$count1++;
						}
						//Bestätigen der Eingabe
						echo "</form>";
					}
				}
				$games -> close();
				$tabelleSQL = "SELECT team_name, scored, received, (t.scored - t.received) AS difference, IFNULL(t.points, 0) as points, 
					t.group FROM team t WHERE t.group LIKE '" . $group . "' ORDER BY points DESC";
				//Einfügen der Tabelle der jeweiligen Gruppe
				if ($table = $mysqli -> query($tabelleSQL)) {
					echo "<h1>Tabelle</h1>";
					echo '<table bgcolor="#FFFFFF" align="center">
								<tr>
								<td>Rank</td>
								<td>Mannschaft</td>
								<td>Tore</td>
								<td>Differenz</td>
								<td>Punkte</td>
								</tr>';

					$count = 1;
					while ($row2 = $table -> fetch_array(MYSQLI_ASSOC)) {
						echo '<tr>';
						echo '<td>' . $count . '</td>' . '<td>' . $row2['team_name'] . '</td>';
						echo '<td>' . $row2['scored'] . ':' . $row2['received'] . '</td>' . '<td>' . $row2['difference'] . '</td>';
						echo '<td>' . $row2['points'] . '</td>';
						echo "</tr>";
						$count++;
					}
					echo "</table>";
					$table -> close();

				} else {//Fehler beim Absetzen der SQL-Anweisung
					echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
				}
				echo "</div>";
				//Ende der Seite der jeweiligen Gruppe

			}
			$result -> close();

		} else {
			//Fehler beim Absetzen der SQL-Anweisung
			echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
		}

	}
	$mysqli -> close();
		?>
</div>
<script type="text/javascript"></script>

