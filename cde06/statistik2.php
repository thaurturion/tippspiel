
<h1>Statistik 2</h1>


<table>
	<tr>
		<th>Seite</th>
		<th>Aufrufe</th>
	</tr>

<?php
   //Verbindung zur DB aufbauen  (Schritt 2)
	$mysqli = new mysqli('localhost', 'root', '', 'meinedb');

	//Verbindungsaufbau ok?
	if ($mysqli->error) {
		//...nein!
		echo ('Fehler beim Verbindungsaufbau (' . $mysqli->errno . '): ' . $mysqli->error);
	} else {
		//...ja!
		//SQL-Anweisung formlieren  (Schritt 3)
		$sql = "select seitenname, zaehler from statistik order by zaehler DESC";
		//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
		if ($result = $mysqli->query($sql)) {
			//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
					
				echo "<tr>";
				echo "  <td>" . $row['seitenname'] . "</td>";
				echo "  <td>" . $row['zaehler'] . "</td>";
				echo "</tr>";
					
			}
			$result->close();
		} else {
			//Fehler beim Absetzen der SQL-Anweisung
			echo ('Fehler beim Senden der SQL-Anweisung (' . $mysqli->errno . '): ' . $mysqli->error);
		}
	}
	$mysqli->close();
?>

</table>