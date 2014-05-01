<?php
	session_start();
	
?>


	<script type="text/javascript">
		jQuery(function(){
			jQuery("#accordion").accordion({
				 heightStyle: "content"
			});
		});
	</script>

	<div id="accordion">
		<h3>Willkommen</h3>
		<div><p>
			<div id="start" class="menuitem">Startseite</div>
			<div id="idee" class="menuitem">Die Idee</div>
			<div id="schule" class="menuitem">Die Schule</div>
			<div id="kontakt" class="menuitem">Kontakt</div>
		</p></div>			
		<h3>Verzeichnis</h3>
		<div><p>
			<div id="ehemaligenverzeichnis" class="menuitem">Ehemaligenverzeichnis</div>
<?php
	if(isset($_SESSION["login"]) && $_SESSION["login"] == 1){
?>	
			<div id="logout" class="menuitem">Logout</div>
<?php
    } else {
?>			
			<div id="login" class="menuitem">Login</div>
<?php
    }
?>			
<?php
	if(isset($_SESSION["login"]) && $_SESSION["login"] == 1){
?>	
			<div id="liste" class="menuitem">Mitgliederliste</div>
			<div id="listenimport" class="menuitem">Mitglieder importieren</div>
			<div id="logliste" class="menuitem">Logs</div>
			<div id="statistik1" class="menuitem">Aufrufstatistik S</div>
			<div id="statistik2" class="menuitem">Aufrufstatistik DB</div>
			<div id="sessionende" class="menuitem">Session beenden</div>
<?php
    }
?>			
		</p></div>			
	</div>

