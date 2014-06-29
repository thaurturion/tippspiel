<?php
$mysqli = new mysqli('localhost','root','','tippspiel');
if($mysqli->error) {
echo('Fehler beim Verbindungsaufbau ('.$mysqli->errno.'): '.$mysqli->error);
} else {
echo $_POST['user'];
if($mysqli->query("DELETE FROM user WHERE ID = ".$_POST['user']) === TRUE) {
echo "geklappert";
} else {
echo $mysqli->error;
}
}
$mysqli->close();
?>