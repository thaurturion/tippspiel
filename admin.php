<?php
if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1){
			?>
<script type="text/javascript">
	jQuery(function() {

		jQuery('#submitbtn').click(function() {
			jQuery.post('handle_ergebnis.php?', jQuery('#ergebnis').serialize(), function(data) {
				jQuery('#content').empty();
				jQuery('#content').append(data);
				loadNavi();
				loadFooter();
				loadHeader();
			}, 'html');

		});

	}); 
</script>

<h1>Hier entsteht die Eingabemaske für die Spielergebnisse.</h1>

<form id="ergebnis" action="handle_ergebnis.php" method="post" onsubmit="return false">
	<table>
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
			$sql = "SELECT a.team_name as ateam, b.team_name as bteam FROM game JOIN team a ON game.teamA = a.ID JOIN team b ON game.teamB = b.ID WHERE a.group='G'";
			//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
			if ($result = $mysqli -> query($sql)) {
				//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)

				while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {

					echo '<tr>';
					echo '<td>' . $row['ateam'] . '</td>' . '<td>' . $row['bteam'] . '</td>' . '<td><input type="text" value="ScoreA"></td>' . '<td><input type="text" value="ScoreB"></td>';
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

</form>

<?php
} else {
	 echo "<script type=text/javascript> jQuery('#content').load('index-cont.php');</script>";
}
?>