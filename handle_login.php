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

	//Verbindung zur DB aufbauen  (Schritt 2)
	$mysqli = new mysqli('localhost', 'root', '', 'tippspiel');

	//Verbindungsaufbau ok?
	if ($mysqli -> error) {
		//...nein!
		echo('Fehler beim Verbindungsaufbau (' . $mysqli -> errno . '): ' . $mysqli -> error);
	} else {
		//...ja!
		//SQL-Anweisung formlieren  (Schritt 3)
		$sql = "select password, admin, username from user where username='" . $_POST['username'] . "'";
		//SQL-Anweisung absetzen und Ergebnistabelle in $result merken
		if ($result = $mysqli -> query($sql)) {
			//Ergebnistabelle auswerten, dazu erste Zeile in $row speichern  (Schritt 4)
			if ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
				//Spalte "pwd" der ersten Zeile gleich übergebenes Kennwort?
				
				$encrpwd = md5($_POST['password']);
				
				echo $encrpwd;
				echo $row['password'];
				
				if ($row['password'] == $encrpwd) {
					
					//...ja! --> Login ok – alles gut!
					$ok = true;
					$username = $row['username'];
					if ($row['admin'] == 1) {
						echo "Du bist Admin!";
						$admin = 1;
						
					}
					/*$m = new LogMessage(20, $_POST['username'] . ' hat sich angemeldet');
					 if(!LogUtil::log($m)){
					 echo "Logging-Fehler";
					 }*/
				} else {
					/*$m = new LogMessage(20, $_POST['username'] . ' konnte nicht angemeldet werden (' . $_POST['pwd'] . ')');
					 if(!LogUtil::log($m)){
					 echo "Logging-Fehler";
					 }*/
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
