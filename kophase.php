<?php
session_start();

require_once ('knockout.class.php');
?>

<script type="text/javascript">
	jQuery(function() {
		for (var i = 0; i < 100; i++) {
			doAjax(i);
		}
		jQuery("#accordion").accordion({
			heightStyle : "content",

		});
	});

	function doAjax(i) {
		jQuery('#submitbtn' + i).click(function() {
			console.log(jQuery('#tipp' + i).serialize());
			jQuery.post('handle_tipp.php?', jQuery('#tipp' + i).serialize(), function(data) {
				jQuery('#content').empty();
				jQuery('#content').load('kophase.php');
			}, 'html');
		});
	}
</script>

<h1>Willkommen bei der KO Phase</h1>
<div id="accordion">
	<h3>Achtelfinale</h3>
	
	<div id="start" class="menuitem"><?php knockout::log(4) ?></div>
	<h3>Viertelfinale</h3>
	<div id="start2" class="menuitem"><?php knockout::log(5) ?></div>
	<h3>Halbfinale</h3>
	<div id="start3" class="menuitem"><?php knockout::log(6) ?></div>
	<h3>Finale/Spiel um 3ten Platz</h3>
	<div id="start4" class="menuitem"><?php knockout::log(7) ?></div>
</div>
	
<script type="text/javascript"></script>

