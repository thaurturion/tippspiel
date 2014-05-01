<script type="text/javascript">
	jQuery(function(){
	
		jQuery('#registrieren').click(function(){
			jQuery('#content').load('registrierung.html');
		});

	
		jQuery('#submitbtn').click(function(){
			jQuery.post(
				'handle_login.php?',
				jQuery('#logindaten').serialize(),
				function(data){
					jQuery('#content').empty();
					jQuery('#content').append(data);
					loadNavi();
				},
				'html'
			);
			
		});
		
	});
</script>

<h1>Willkommen beim WM Tippspiel</h1>

<form id="logindaten" action="handle_login.php" method="post" onsubmit="return false">
	<div id="left">
		Benutzername:<br>
		Passwort:<br>
		<input id="submitbtn" type="submit" value="Anmelden" style="margin-top:20px">
	</div>
	<div id="right">
		
		<input type="text" name="username">
		<br>
		<input type="password" name="password">
		<br>

		
	</div>

</form>