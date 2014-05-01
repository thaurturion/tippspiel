<?php
session_start();
?>


<script type="text/javascript">
	jQuery(function() {
		jQuery("#accordion").accordion({
			heightStyle : "content",
			collapsible:true,
			active:false
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
			<div id="gruppenphase" class="menuitem">
				Dein Tipp!
			</div>
		</p>
	</div>
	<h3>Verzeichnis</h3>
	<div>
		<p>
			<div id="ehemaligenverzeichnis" class="menuitem">
				Ehemaligenverzeichnis
			</div>
			<?php
if(isset($_SESSION["login"]) && $_SESSION["login"] == 1){
			?>
			<div id="liste" class="menuitem">
				Benutzeraccount
			</div>
			<?php
			}
			?>
		</p>
	</div>
</div>
