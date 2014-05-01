<?php
	session_start();
?>

<h1>Statistik 1</h1>


<table>
	<tr>
		<th>Seite</th>
		<th>Aufrufe</th>
	</tr>

<?php
	foreach($_SESSION as $key=>$value){
		if(strpos($key, 'statistik_') !== false){
			echo "<tr>";
			echo "  <td>" . $key . "</td>";
			echo "  <td>" . $_SESSION[$key] . "</td>";
			echo "</tr>";
		}
	}
?>

</table>