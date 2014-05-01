<?php

if(isset($_POST['id']) && !empty($_POST['id'])){

		//Verbindung zur DB aufbauen  (Schritt 2)
		$mysqli = new mysqli('localhost', 'root', '', 'meinedb');

		//Verbindungsaufbau ok?
		if (!$mysqli->error) {
			$sql = "delete from logindaten where id='" . $_POST['id'] . "'";
			$mysqli->query($sql);
		}
		
		$mysqli->close();
		
}

?>

