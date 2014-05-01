<?php
	session_start();
	
	if(isset($_SESSION['statistik_kontakt'])){
		$_SESSION['statistik_kontakt'] = $_SESSION['statistik_kontakt']+1;
	} else {
		$_SESSION['statistik_kontakt'] = 1;
	}

	require_once('myfunctions.php');
	erhoeheSeitenzaehler('kontakt');
	
?>

<div class="inhalt">
  <h1 class="inhalt_ueberschrift">Kontakt</h1>
  <!-- Kontaktdaten der Schule -->
  <table>
	<tr>
	  <th>Adresse:</th>
	  <td>Heerstr. 150, 78628 Rottweil</td>
	</tr>
	<tr>
	  <th>Tel:</th>
	  <td>0741-2708-300</td>
	</tr>
	<tr>
	  <th>Fax:</th>
	  <td>0741-2708-310</td>
	</tr>
	<tr>
	  <th>E-Mail:</th>
	  <td>info@nbs-rottweil.de</td>
	</tr>
	<tr>
	  <th>&Ouml;ffnungszeiten<br>des Sekretariats:</th>
	  <td>Mo-Fr:<br>7:30 Uhr - 16:30 Uhr</td>
	</tr>
  </table>
</div>

	<div class="besucherzaehler"><?php echo $_SESSION["statistik_kontakt"] ?></div>
