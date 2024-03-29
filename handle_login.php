<?php
session_start();

/*require_once('LogMessage.class.php');
 require_once('LogUtil.class.php');
 */
//POST-Parameter überprüfen (Schritt 1)
if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {

	$ok = false;
	$admin = 0;
	$username = '';
	$userid = 0;

	//Verbindung zur DB aufbauen  (Schritt 2)
	$mysqli = new mysqli('localhost', 'root', '', 'tippspiel');

	//Verbindungsaufbau ok?
	if ($mysqli -> error) {
		//...nein!
		echo('Fehler beim Verbindungsaufbau (' . $mysqli -> errno . '): ' . $mysqli -> error);
	} else {
		//...ja!
		//SQL-Anweisung formlieren  (Schritt 3)
		$sql = "select id, password, admin, username from user where username='" . $_POST['username'] . "'";
		//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
		if ($result = $mysqli -> query($sql)) {
			//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
			if ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
				//Spalte "pwd" der ersten Zeile gleich übergebenes Kennwort?
				
				$encrpwd = md5($_POST['password']);
				
				if ($row['password'] == $encrpwd) {
					
					//...ja! --> Login ok – alles gut!
					$ok = true;
					$username = $row['username'];
					$userid = $row['id'];
					if ($row['admin'] == 1) {
						echo "Du bist Admin!";
						$admin = 1;
						
					}
				}
			} else {
				//Kein Datensatz vorhanden! (keine erste Zeile der Ergebnistabelle)
				echo "Keinen Eintrag zum Namen '" . $_POST['username'] . "' gefunden";
			}
			$result -> close();
		} else {
			//Fehler beim Absetzen der SQL-Anweisung
			echo('Fehler beim Senden der SQL-Anweisung (' . $mysqli -> errno . '): ' . $mysqli -> error);
		}
	}
	$mysqli -> close();

	//Login ok? Ausgabe!
	if ($ok) {
		//...ja!
		$_SESSION["login"] = 1;
		$_SESSION["username"] = $username;
		$_SESSION["userid"] = $userid;
		echo "<h2>Login akzeptiert</h2>";
		
		if($admin ==  1) {
			$_SESSION["admin"] = 1;
		}
	} else {
		//...nein!
		$_SESSION["login"] = 0;
		$_SESSION["admin"] = 0;
		echo "<h1>Login nicht akzeptiert</h2>";
	}

} else {
	//POST-Parameter sind teilweise gar nicht vorhanden oder leer!
	echo "Ungültige Daten";
}
?>
