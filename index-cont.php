<?php
session_start();
?>

<h1>Willkommen beim WM Tippspiel</h1>

<p>

	Die Endrunde der Fußball-Weltmeisterschaft 2014 (portugiesisch Copa do Mundo FIFA, englisch FIFA World Cup) der Männer ist die 20. Ausspielung des bedeutendsten Turniers für Fußball-Nationalmannschaften und findet vom 12. Juni bis zum 13. Juli 2014 in Brasilien statt. Titelverteidiger ist der Weltmeister von 2010, Spanien. Der Sieger ist automatisch für den FIFA-Konföderationen-Pokal 2017 qualifiziert.

	Der Beschluss des FIFA-Exekutivkomitees, Brasilien zum zweiten Mal nach 1950 zum Gastgeber der Weltmeisterschaft zu ernennen, fiel am 30. Oktober 2007 in Zürich. Als Gastgeber der WM war Brasilien automatisch Ausrichter des Konföderationen-Pokals 2013.
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
	$mysqli = new mysqli('localhost', 'root', '', 'tippspiel');
	$tabelle = $mysqli->query("SELECT * FROM user");
	while ($z = mysql_fetch_array($tabelle)) {
		echo '<tr>';
		echo '<td>' . $z['username'] . '</td>' . '<td class="number">' . $z['point'] . '</td>';
		echo "</tr>";
	} //while
?>
</table>
