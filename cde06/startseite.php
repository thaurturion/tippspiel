<?php
	session_start();
	
	if(isset($_SESSION['statistik_startseite'])){
		$_SESSION['statistik_startseite'] = $_SESSION['statistik_startseite']+1;
	} else {
		$_SESSION['statistik_startseite'] = 1;
	}
	
	require_once('myfunctions.php');
	erhoeheSeitenzaehler('startseite');
?>

    <!-- Klassenfoto -->
    <p class="klassenfoto"><img src="Klassenfoto_klein.jpg"></img></p>

	<div class="besucherzaehler"><?php echo $_SESSION["statistik_startseite"] ?></div>
