<script type="text/javascript">
	jQuery(function(){
		
		jQuery('img').click(function(){
			var id = jQuery(this).attr('id');
			jQuery.post(
				'handle_deletelog.php?',
				{ id: id
				},
				function(data){
					jQuery('#content').load('logliste.php');
				},
				'html'
			);
		});
		
		jQuery('#s10').change(function(){
			if(jQuery('#s10').is(':checked')){
			  jQuery('.s_10').fadeIn(500);
			} else {
			  jQuery('.s_10').fadeOut(500);
			}
		});
		
		jQuery('#s20').change(function(){
			if(jQuery('#s20').is(':checked')){
			  jQuery('.s_20').fadeIn(500);
			} else {
			  jQuery('.s_20').fadeOut(500);
			}
		});
		
		jQuery('#s30').change(function(){
			if(jQuery('#30').is(':checked')){
			  jQuery('.s_30').fadeIn(500);
			} else {
			  jQuery('.s_30').fadeOut(500);
			}
		});
		
	});
</script>


<h1>Log-Liste</h1>

<div style="text-align:center;margin-bottom:20px;">
	<input type="checkbox" id="s10" checked="checked"> S10
	<input type="checkbox" id="s20" checked="checked"> S20
	<input type="checkbox" id="s30" checked="checked"> S30
</div>


<table>
	<tr>
		<th>Zeitpunkt</th>
		<th>Gewichtung</th>
		<th>Nachricht</th>
		<th>!</th>
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
		$sql = "select time, severity, message from log order by time desc";
		//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
		if ($result = $mysqli->query($sql)) {
			//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
					
				echo "<tr class='s_" . $row['severity'] . "'>";
				echo "  <td>" . $row['time'] . "</td>";
				echo "  <td>" . $row['severity'] . "</td>";
				echo "  <td>" . $row['message'] . "</td>";
				echo "  <td><img id='" . $row['time'] . "' src='delete.png' style='cursor:pointer;'></td>";
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