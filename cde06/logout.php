<?php

	session_start();
	
	unset($_SESSION['login']);
	unset($_SESSION['admin']);

?>


<script type="text/javascript">
	jQuery(function(){
		loadNavi();
	});
</script>

Sie wurden erfolgreich abgemeldet!