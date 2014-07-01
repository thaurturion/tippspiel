<?php
session_start();
?>
<script type="text/javascript">
function onClickEvent(userID) {
			
			jQuery.post('delete.php?', {user:userID}, function(data) {
				jQuery('#content').load("usermngmnt.php");
				
			}, 'html');
}  

</script>
<table bgcolor="#FFFFFF" align="center">
	<tr>
		<td>Rank</td>
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
		$sql = "SELECT * FROM user order by point DESC";
		//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
		if ($result = $mysqli -> query($sql)) {
			//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
			$count = 1;
			while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
				?><tr>
				<td><?=$count ?></td><td><?= $row['username'] ?></td><td><?= $row['point'] ?></td><td><div id="deletion">
				<input type="button" value="Delete" onclick="onClickEvent(<?=$row['ID']?>);"/></div></td>
				</tr>
				<?php
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
