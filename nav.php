<?php
session_start();
?>

<script type="text/javascript">
	jQuery(function() {
		jQuery("#accordion").accordion({
			heightstyle : "content",
			collapsible : true,
			active : false
		});
	}); 
</script>

<div id="accordion">
	<h4>Willkommen</h4>
	<div>
		<p>
			<div id="start" class="menuitem">
				Startseite
			</div>
			<?php
				if(isset($_SESSION["login"]) && $_SESSION["login"] == 1){
			?>
			<div id="benutzerverwaltung" class="menuitem">
				Benutzerverwaltung
			</div>
			<?php
			}
			?>
		</p>
	</div>
	<?php
		if(isset($_SESSION["login"]) && $_SESSION["login"] == 1){
	?>
	
	<h3>Deine Tipps</h3>
	<div>
		<p>
			<div id="gruppenphase" class="menuitem">
				Gruppenphase
			</div>
			<div id="kophase" class="menuitem">
				KO-Phase
			</div>

		</p>
	</div>
	<h3>Statistik</h3>
	<div>
		<p>
			<div id="highscore" class="menuitem">
				Highscore
			</div>
			<div id="highscore" class="menuitem">
				Graphs
			</div>
		</p>
	</div>
	
	<?php
		}
	?>
	<h3>Alles rund um die WM</h3>
	<div>
		<p>
			<div id="kicker" class="menuitem">
				<a href="http://www.kicker.de" target="_blank">Kicker</a>
			</div>
		</p>
	</div>
</div>
