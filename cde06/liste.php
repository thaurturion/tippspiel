<script type="text/javascript">
	jQuery(function(){
		
		jQuery('img').click(function(){
			var id = jQuery(this).attr('id');
			jQuery.post(
				'handle_delete.php?',
				{ id: id
				},
				function(data){
					//alert(data);
					jQuery('#content').load('liste.php');
				},
				'html'
			);
		});
		
	});
</script>


<h1>Liste</h1>


<table>
	<tr>
		<th>Name</th>
		<th>Kennwort</th>
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
		$sql = "select id, name, pwd from logindaten";
		//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
		if ($result = $mysqli->query($sql)) {
			//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
					
				echo "<tr>";
				echo "  <td>" . $row['name'] . "</td>";
				echo "  <td>" . $row['pwd'] . "</td>";
				echo "  <td><img id='" . $row['id'] . "' src='delete.png' style='cursor:pointer;'></td>";
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