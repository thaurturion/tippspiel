<?php
    $username = $_POST['username'];
	$password = $_POST['password'];
	
	if($username == "Max" && $password == "lol") {
		echo "Login erfolgreich";
	} else {
		echo "ÄÄÄÄTsch falsche Logindaten";
	}
	
?>