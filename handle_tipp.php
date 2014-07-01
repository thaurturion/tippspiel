<?php

session_start();

// Tipp eintragen, falls es noch keinen Tipp von diesem User zu diesem Spiel gibt
// Tipp updaten, falls es bereits einen Tipp dazu gibt

foreach ($_POST as $key => $value) {
	echo $key . ':' . $value . '<br>';
}

$gameID = $_POST['gameID'];
$tippID = $_POST['tippID'];

echo $gameID;
echo $gameID;

if (isset($_POST[$gameID . 'a']) && isset($_POST[$gameID . 'b'])) {

	$ida = $_POST[$gameID . 'a'];
	$idb = $_POST[$gameID . 'b'];
	//Verbindung zur DB aufbauen  (Schritt 2)
	$mysqli = new mysqli('localhost', 'root', '', 'tippspiel');

	//Verbindungsaufbau ok?
	if ($mysqli -> error) {
		//...nein!
		echo('Fehler beim Verbindungsaufbau (' . $mysqli -> errno . '): ' . $mysqli -> error);
	} else {
		$checkDate = $mysqli -> query("SELECT datetime FROM game WHERE id =$gameID") -> fetch_array(MYSQLI_ASSOC);
		
		if (strtotime($checkDate['datetime']) >= date("Y-m-d H:i:s", time())) {
			echo $checkDate['datetime'];	
				
			if ($tippID != NULL) {
				$sql = "UPDATE tipp SET tippScoreA = " . $ida . ", tippScoreB = " . $idb . " WHERE game_ID = " . $gameID . " AND user_ID =" . $_SESSION["userid"] . " AND id=" . $tippID;
			} else if ($tippID == NULL AND $ida != '' AND $idb != '') {
				$sql = "INSERT INTO tipp (game_ID, user_ID, tippScoreA, tippScoreB) 
			values (" . $gameID . ", " . $_SESSION["userid"] . ", " . $ida . ", " . $idb . ")";
			} else {
				echo "Bitte erst eine vollständige eingabe durchführen";
			}

			if ($mysqli -> query($sql) === TRUE) {
				echo "Tippeingabe erfolgreich.";
			} else {
				//Fehler beim Absetzen der SQL-Anweisung
				echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
			}
		} 
		$mysqli -> close();
	}
} else {
	echo "Ung&uuml;ltige Eingabe";
}
?>