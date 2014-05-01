<?php
	session_start();
	
	if(isset($_SESSION['statistik_schule'])){
		$_SESSION['statistik_schule'] = $_SESSION['statistik_schule']+1;
	} else {
		$_SESSION['statistik_schule'] = 1;
	}
	
	require_once('myfunctions.php');
	erhoeheSeitenzaehler('schule');
	
?>

    <div class="inhalt">
      <div class="rechtsbuendig">
        <img src="schule.jpg">
      </div>
      <h1 class="inhalt_ueberschrift">Die Schule</h1>
      Die zehn Schularten der Nell-Breuning Schule mit 1740 Sch&uuml;ler und Sch&uuml;lerinnen und 125 Lehrkr&auml;ften bieten
      zahlreiche Schulabschl&uuml;sse und verschiedene Berufsausbildungen in einem Geb&auml;ude an. Das in den Jahren
      1971 bis 2001 erbaute Schulhaus/-geb&auml;ude liegt an einer sch&ouml;nen Hanglage in Rottweil. Unser Einzugsbereich
      reicht mit f&uuml;nf Landkreisen allerdings weit &uuml;ber unseren heimatlichen Landkreis Rottweil hinaus.

      <p><a href="http://www.nbs-rottweil.de" target="_blank">Hier</a> geht's zur Schuleseite</p>
    </div>

	<div class="besucherzaehler"><?php echo $_SESSION["statistik_schule"] ?></div>
