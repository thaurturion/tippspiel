<?php
session_start();
?>

<script type="text/javascript">
	$('#navigation').slimmenu({
		resizeWidth : false,
		collapserTitle : 'Main Menu',
		animSpeed : 'medium',
		easingEffect : null,
		indentChildren : false,
		childrenIndenter : '&nbsp;'
	}); 
</script>

<ul id="nav" class="slimmenu">

	<li id="start">
		<a id="welcome" href="#">Willkommen</a>
		<ul style="display: none; height: 90px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">

			<li id="results">
				<a href="#">Spielergebnisse eintragen</a>
			</li>
			<li id="usermngmt">
				<a href="#">Benutzer verwalten</a>
			</li>

		</ul>
	</li>

	
	<li id="p1">
		<a href="#">Meine Tipps</a>
		<ul style="display: none; height: 90px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
			<li id="gruppenphase">
				<a href="#">Gruppenphase</a>
			</li>
			<li id="kophase">
				<a href="#">KO-Phase</a>
			</li>
		</ul>
	</li>
	<li id="p2">
		<a href="#">Statistiken</a>
		<ul style="display: none; height: 90px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
			<li id="highscore">
				<a href="#">Highscore</a>
			</li>
		</ul>

	<li id="end">
		<a href="#">Alles rund um die WM</a>
		<ul style="display: none; height: 90px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
			<li>
				<a href="http://www.kicker.de" target="_blanc">Kicker</a>
			</li>

			<li>
				<a href="http://www.bundesliga.de" target="_blanc">Bundesliga</a>
			</li>
		</ul>

	</li>

</ul>

