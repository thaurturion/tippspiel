<?php
session_start();
?>

<h1>Willkommen <?php
if (isset($_SESSION['username'])) {
	$name = $_SESSION['username'];
	echo $name;
}; ?> beim WM Tippspiel</h1>

<p>
	TEXT MANU
	
</p>

http://jasonweaver.name/lab/flexiblenavigation/

http://docs.dev7studios.com/jquery-plugins/caroufredsel



<p>
	Tabelle der aktuellen Teilnehmer
</p>

<table bgcolor="#FFFFFF" align="center">
	<tr>
		<td>Spieler</td>
		<td>Punktestand</td>

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
		$sql = "SELECT * FROM user";
		//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
		if ($result = $mysqli -> query($sql)) {
			//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
			while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {

				echo '<tr>';
				echo '<td>' . $row['username'] . '</td>' . '<td class="number">' . $row['point'] . '</td>';
				echo "</tr>";

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
