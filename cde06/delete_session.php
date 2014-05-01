<?php
	session_start();
	session_destroy();
?>

<script type="text/javascript">
	jQuery(function(){
		loadNavi();
	});
</script>

<h1>Session beendet</h1>

<p>
Alle Session-Daten wurden gelöscht.
</p>