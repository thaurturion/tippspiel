<?php

	session_start();
	
	unset($_SESSION['login']);
	unset($_SESSION['admin']);
	

?>


<script type="text/javascript">
	jQuery('#mainpage').click(function(){
			jQuery('#content').load('index-cont.php');
		});
	
	jQuery(function(){
		loadHeader();
		loadNavi();
		loadFooter();
	});
</script>

Sie wurden erfolgreich abgemeldet!

<span id="mainpage" style="color:#00a;cursor:pointer;">Zurück zur Startseite</span>
