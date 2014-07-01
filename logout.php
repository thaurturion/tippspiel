<?php

	session_start();
	
	unset($_SESSION['login']);
	unset($_SESSION['admin']);
	unset($_SESSION['username']);
	

?>


<script type="text/javascript">
	jQuery('#mainpage').click(function(){
			jQuery('#content').load('index-cont.php');
		});
	
	jQuery(function(){
		loadHeader();
		jQuery('#p1').hide();
		jQuery('#p2').hide();
		jQuery('#results').hide();
		jQuery('#usermngmt').hide();
		loadFooter();
	});
</script>

Sie wurden erfolgreich abgemeldet!

<span id="mainpage" style="color:#00a;cursor:pointer;">Zurück zur Startseite</span>
