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
					
					//Einfügen der Tabelle der jeweiligen Gruppe
					$count = 1;
					while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
						echo '<table bgcolor="#FFFFFF" align="center">
							<tr>
							<td>Rank</td>
							<td>Mannschaft</td>
							<td>Punktestand</td>
							</tr>';
						echo '<tr>';
						echo '<td>' . $count . '</td>' . '<td>' . $row['username'] . '</td>' . '<td class="number">' . $row['point'] . '</td>';
						echo "</tr>";
						$count++;
					}
					
					//Ende der Seite der jeweiligen Gruppe
					echo "</div>";
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