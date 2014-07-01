<?php
session_start();
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>WM-Tippspiel</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Cache nicht anlegen -->
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="expires" content="0">
		<!-- Ende Cache nicht anlegen -->

		<meta name="description" content="WM-Tippspiel">
		<meta name="author" content="Fabian Bode, Manuel Digeser, Marc Kaltenbach">

		<!--FAVICON-->
		<link rel="shortcut icon" href="images/fav.ico"/>
		<link rel="icon" href="images/fav.ico"/>

		<!--CSS files-->
		<link rel="stylesheet" type="text/css" href="css/layout.css">
		<link href="css/ui-lightness/jquery-ui-1.10.2.custom.css" rel="stylesheet">
		<link rel="stylesheet" href="css/slimmenu.css" type="text/css">

		<!--Javascript Files-->
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<script src="js/jquery-ui-1.10.2.custom.js"></script>

		<script type="text/javascript">
			jQuery(function() {
				//Kein AJAX Cache.
				jQuery.ajaxSetup({
					cache : false
				});

				loadHeader();
				jQuery('#content').load('index-cont.php');

				loadFooter();
				loadNavi();
				loadAdmin();

			});

			function loadFooter() {
				jQuery('#footer').load('footer.php');
			}

			function loadAdmin() {
				jQuery('#content').load('admin.php');
			}

			function loadHeader() {
				jQuery('header').load('header.php');
			}

			function loadNavi() {
				jQuery('#navigation').load('nav.php', function() {

					jQuery('#welcome').click(function() {
						jQuery('#content').load('index-cont.php');
					});

					jQuery('#results').click(function() {
						jQuery('#content').load('admin.php');
					});

					jQuery('#gruppenphase').click(function() {
						jQuery('#content').load('gruppenphase.php');
					});

					jQuery('#kophase').click(function() {
						jQuery('#content').load('kophase.php');
					});

					jQuery('#highscore').click(function() {
						jQuery('#content').load('highscore.php');
					});

					jQuery('#usermngmt').click(function() {
						jQuery('#content').load('usermngmt.php');
					});	
					setTimeout(customize(), 3000);
				});

			};
			
			function customize() {
					jQuery('#p1').hide();
					jQuery('#p2').hide();
					jQuery('#results').hide();
					jQuery('#usermngmt').hide();
					<?php
						if(isset($_SESSION["login"]) && $_SESSION["login"] == 1){
					?>
							jQuery('#p1').show();
							jQuery('#p2').show();
					<?php
						}
						if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1){
					?>
							jQuery('#results').show();
							jQuery('#usermngmt').show();
					<?php
						}
					?>
			};
		</script>

	</head>

	<body>

		<div id="wrapper">
			<div id="navigation"></div>
			<header>

			</header>
			<div id="content"></div>
			<div id="footer"></div>

		</div>
		<script src="js/jquery.slimmenu.min.js"></script>
	</body>
</html>

