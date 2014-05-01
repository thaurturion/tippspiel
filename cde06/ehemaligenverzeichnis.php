<?php
	session_start();
	
	if(isset($_SESSION['statistik_ehemaligenverzeichnis'])){
		$_SESSION['statistik_ehemaligenverzeichnis'] = $_SESSION['statistik_ehemaligenverzeichnis']+1;
	} else {
		$_SESSION['statistik_ehemaligenverzeichnis'] = 1;
	}

	require_once('myfunctions.php');
	erhoeheSeitenzaehler('ehemaligenverzeichnis');

?>

 
 <div class="inhalt">

	<h1 class="inhalt_ueberschrift">Das Ehemaligenverzeichnis</h1>

	<p>
	Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
	</p>
	
</div>	

	<div class="besucherzaehler"><?php echo $_SESSION["statistik_ehemaligenverzeichnis"] ?></div>
