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
			$sql = "SELECT DISTINCT t.group as group FROM team t";
			//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
			if ($result = $mysqli -> query($sql)) {
				//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
				$b = $result;
				while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
					echo '<li>';
					echo '<td><a href="#gruppeA">Gruppe' . strtoupper($row['group']) . '</a>';
					echo "</li>";

				}
				echo '</ul>';
				
				while ($z = $b -> fetch_array(MYSQLI_ASSOC)) {
					echo '<div id="gruppe'. strtoupper($z['group']) .'">';
					echo 'TESTETSTEST';
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