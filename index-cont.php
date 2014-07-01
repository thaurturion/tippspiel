<?php
session_start();
?>


<h1>Willkommen <?php
if (isset($_SESSION['username'])) {
	$name = $_SESSION['username'];
	echo $name;
}; ?> beim WM Tippspiel</h1>

<p>
Herzlich Willkommen zum interaktiven Tippspiel der FIFA Fußball Weltmeisterschaft 2014 in Brasilien dem Herzen des Fußballs. Auf unserer Seite findest du den ultimativen Tippspaß mit deinen Freunden, Arbeitskollegen oder deiner Familie. Des Weiteren haben wir für euch zahlreiche Statistiken, Fakten und Infos rund um die WM auf unserer Seite aufbereitet. 

Beweise dein Fußballverstand und werde zum Tippweltmeister der FIFA Fußball Weltmeisterschaft 2014!
</p>
<h1>Die Fünf Besten Tipper</h1>

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
		$sql = "SELECT * FROM user order by point DESC LIMIT 5";
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
