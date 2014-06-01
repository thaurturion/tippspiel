<?php
//TODO: Vor Livegang MD5 Encryption austauschen.
//TODO: Trigger für löschung der tipps beim löschen eines spielers einführen
?>
<script type="text/javascript">
	jQuery('#register').click(function() {
		jQuery('#content').load('register.html');
	});

	jQuery(function() {
		jQuery('#submitbtn').click(function() {
			jQuery.post('handle_login.php?', jQuery('#logindaten').serialize(), function(data) {
				jQuery('#content').empty();
				jQuery('#content').load('index-cont.php');
				loadNavi();
				loadFooter();
				loadHeader();				
			}, 'html');

		});

	}); 
</script>

<h1>Willkommen beim WM Tippspiel</h1>

<form id="logindaten" action="handle_login.php" method="post" onsubmit="return false">
	<div id="left">
		Benutzername:
		<br>
		Passwort:
		<br>
		<input id="submitbtn" type="submit" value="Anmelden" style="margin-top:20px">
	</div>
	<div id="right">

		<input type="text" name="username">
		<br>
		<input type="password" name="password">
		<br>
	</div>
</form>

<p>
	Sollten Sie noch nicht registriert sein, dann können Sie sich <span id="register" style="color:#00a;cursor:pointer;">hier</span> anmelden!
</p>