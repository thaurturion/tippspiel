<?php
session_start();
?>

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

				//TODO: Matches of group + enter of tip
				$group = $row['group'];

				echo "<h1>Spiele</h1>";
				//...ja!
				//SQL-Anweisung formlieren  (Schritt 3)
				echo $_SESSION["userid"];
				
				$sqlMatches = "SELECT g.id id, g.datetime datetime, g.scoreA sA, g.scoreB sB, a.team_name ateam, b.team_name bteam FROM game g 
				JOIN team a ON g.teamA = a.ID JOIN team b ON g.teamB = b.ID LEFT JOIN tipp ti ON ti.user_ID =".$_SESSION["userid"]." AND ti.gameID = g.id
				WHERE a.group LIKE '" . $group . "' ORDER BY g.datetime ASC";
				//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
				if ($games = $mysqli -> query($sqlMatches)) {
					//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
					echo "<table>";
					echo "<tr>
					<td>Datum</td>
					<td>Mannschaft A</td>
					<td>Tipp A</td>
					<td>Mannschaft B</td>
					<td>Tipp B</td>
					<td>Ergebnis</td>
					<td>Absenden</td>
					</tr>";
					while ($row3 = $games -> fetch_array(MYSQLI_ASSOC)) {

						echo '<tr><form action="handle_tipp.php" method="POST">';
						echo '<td>' . $row3['datetime'] . '</td>' . '<td>' . $row3['ateam'] . '</td>' . '<td><input type="text" 
						value="' . $row3['sA'] . '" name="' . $row3['id'] . 'a" size="2">' . '</td>' . '<td>' . $row3['bteam'] . '</td>' . '<td><input 
						type="text" value="' . $row3['sB'] . '" name="' . $row3['id'] . 'b" size="2"></td><td>'. $row3['sA'] .':'. $row3['sB'] .'</td><td><input type="submit" value="Best&auml;tigen"</td>';
						echo "</form></tr>";

					}
					echo "</table>";
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
						echo '<td>' . $count . '</td>' . '<td>' . $row2['team_name'] . '</td>' . '<td>' . $row2['scored'] . ':' . $row2['received'] . '</td>' . '<td>' . $row2['difference'] . '</td>' . '<td>' . $row2['points'] . '</td>';
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

<script type="text/javascript">$('#tabs').tabs();</script>