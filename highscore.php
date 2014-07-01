<div class="startseite">

Wer ist aktuell der Chef unter den Tippern und wer ist der größte Lappen? Hier siehst du den aktuellen Highscore:	
	
<div>

<br>

<div class="tabelleturnierteilnehmer">

Aktuelle Highscoretabelle:

</div>

<br>

<table bgcolor="#FFFFFF" align="center" class="tabelleteilnehmer">
	<tr>
		<td class="ueberschrifttabelle">  Rank</td>
		<td class="ueberschrifttabelle">  Spieler</td>
		<td class="ueberschrifttabelle"> Punktestand</td>

	</tr>
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
		$sql = "SELECT * FROM user order by point DESC";
		//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
		if ($result = $mysqli -> query($sql)) {
			//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
			$count = 1;
			while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {

				echo '<tr>';
				echo '<td class="tabelleteilnehmer">' . $count . '</td>' . '<td class="tabelleteilnehmer">' . $row['username'] . '</td>' . '<td class="tabelleteilnehmer">' . $row['point'] . '</td>';
				echo "</tr>";
				$count++;
			}
			$result -> close();
		} else {
			//Fehler beim Absetzen der SQL-Anweisung
			echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
		}
	}
	$mysqli -> close();
	?>
</table>
