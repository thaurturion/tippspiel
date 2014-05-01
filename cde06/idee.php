<?php
	session_start();
	
	if(isset($_SESSION['statistik_idee'])){
		$_SESSION['statistik_idee'] = $_SESSION['statistik_idee']+1;
	} else {
		$_SESSION['statistik_idee'] = 1;
	}
	
	require_once('myfunctions.php');
	erhoeheSeitenzaehler('idee');
	
?>

    <div class="inhalt">
      <div class="rechtsbuendig">
        <img src="cde.jpg">
      </div>
      <h1 class="inhalt_ueberschrift">Die Idee</h1>
      Der Club der Ehemaligen der Nell-Breuning Schule dient in erster Linie
      der gegenwartsbezogenen und zeitnahen Organisation von Daten von ehemaligen
      Sch&uuml;lerinnen und Sch&uuml;lern sowie Lehrerinnen und Lehrern dieser Schule. Mit Hilfe dieser Daten
      soll es ehemaligen Sch&uuml;lern m&ouml;glich sein, Ihre damaligen Mitsch&uuml;ler auf einfache Weise zu
      kontaktieren, beispielsweise f&uuml;r die Organisation eines Klassentreffens. Eine webbasierte
      Umsetzung erm&ouml;glicht eine hohe Erreichbarkeit der Daten.
    </div>

	<div class="besucherzaehler"><?php echo $_SESSION["statistik_idee"] ?></div>
	
