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
					echo '<td><a href="#gruppe'. strtoupper($row['group']) . '">Gruppe' . strtoupper($row['group']) . '</a>';
					echo "</li>";
				}
				$result -> close();
			} else {
				//Fehler beim Absetzen der SQL-Anweisung
				echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
			}



		?>
	</ul>

	<?php
	if ($result = $mysqli -> query($sql)) {
		//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			echo '<div id="gruppe' . strtoupper($row['group']) . '">';

			$tabelleSQL = "SELECT team_name, scored, received, (t.scored - t.received) AS difference, IFNULL(t.points, 0) as points, t.group FROM 
					team t WHERE t.group LIKE '" . $row['group'] . "'  ORDER BY points DESC";
			//Einfügen der Tabelle der jeweiligen Gruppe
			if ($table = $mysqli -> query($tabelleSQL)) {
				echo '<table bgcolor="#FFFFFF" align="center">
								<tr>
								<td>Rank</td>
								<td>Mannschaft</td>
								<td>Tore</td>
								<td>Differenz</td>
								<td>Punkte</td>
								</tr>';
				echo '<tr>';
				$count = 1;
				while ($row2 = $table -> fetch_array(MYSQLI_ASSOC)) {

					echo '<td>' . $count . '</td>' . '<td>' . $row2['team_name'] . '</td>' . '<td>' . $row2['scored'] . ':' . $row2['received'] . '</td>' . 
					'<td>' . $row2['difference'] . '</td>' . '<td>' . $row2['points'] . '</td>';
					echo "</tr>";
					$count++;
				}
				
				echo "</div>";
				$table -> close();
			} else {//Fehler beim Absetzen der SQL-Anweisung
				echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
			}

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