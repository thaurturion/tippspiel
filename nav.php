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
		<a href="#">Willkommen</a>
		<ul style="display: none; height: 90px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
			<li>
				<a href="#">Slim Menu 1.1</a>
			</li>

			<li>
				<a href="#">Slim Menu 1.2</a>
			</li>
		</ul>
	</li>
	<?php
	if(isset($_SESSION["login"]) && $_SESSION["login"] == 1){
	?>
	<li>
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

	<li>
		<a href="#">Statistiken</a>
		<ul style="display: none; height: 90px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
			<li id="highscore">
				<a href="#">Highscore</a>
			</li>

			<li>
				<a href="#">Slim Menu 3.2</a>
			</li>
		</ul>
	<?php
	}
	?>
	<li id="end">
		<a href="#">Alles rund um die WM</a>
		<ul style="display: none; height: 90px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
			<li>
				<a href="#">Slim Menu 3.1</a>
			</li>

			<li>
				<a href="#">Slim Menu 3.2</a>
			</li>
		</ul>

	</li>

</ul>

