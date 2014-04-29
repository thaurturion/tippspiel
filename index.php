<html>
	<head>

		<title>WM-Tippspiel</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="css/layout.css">
		<link rel="stylesheet" href="css/animated-menu.css"/>

		<script src="js/jquery-1.3.js" type="text/javascript"></script>
		<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
		<script src="js/animated-menu.js" type="text/javascript"></script>

		<script type="text/javascript">
			jQuery(function() {
				jQuery('#content').load('index-cont.php');
			});
		</script>

		<link rel="shortcut icon" href="images/favicon.ico"/>
		<link rel="icon" href="images/favicon.ico"/>
	</head>

	<body>

		<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			session_start();

			$username = $_POST['username'];
			$passwort = $_POST['passwort'];

			$hostname = $_SERVER['HTTP_HOST'];
			$path = dirname($_SERVER['PHP_SELF']);

			// Benutzername und Passwort werden überprüft
			if ($username == 'benjamin' && $passwort == 'geheim') {
				$_SESSION['angemeldet'] = true;

				// Weiterleitung zur geschützten Startseite
				if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
					if (php_sapi_name() == 'cgi') {
						header('Status: 303 See Other');
					} else {
						header('HTTP/1.1 303 See Other');
					}
				}

				header('Location: http://' . $hostname . ($path == '/' ? '' : $path) . '/index.php');
				exit ;
			}
		}
		?>

		<div id="wrapper">
			<header>
				<div id="logo">
					<img src="images/logo.jpg" />
				</div>
				<div id ="login">
					<a href="#" onclick="jQuery('#content').load('login.php')">Login</a>
				</div>

				<span id="desc"><a href="#"><h2>WM-Tippspiel</h2></a></span>

			</header>
			<nav>

				<ul>
					<li class="green">
						<p>
							<a href="#" onclick="jQuery('#content').load('index-cont.php')">Home</a>
						</p>
						<p class="subtext">
							Wette mit und gewinne tolle Preise!
						</p>
					</li>
					<li class="yellow">
						<p>
							<a href="#" onclick="jQuery('#content').load('tippabgabe.html')">Tippabgabe</a>
						</p>
						<p class="subtext">
							Mit der Abgabe eines Tipps kannst du tolles erreichen.
						</p>
					</li>
					<li class="red">
						<p>
							<a href="#">Contact</a>
						</p>
						<p class="subtext">
							Get in touch
						</p>
					</li>
					<li class="blue">
						<p>
							<a href="#">Impressum</a>
						</p>
						<p class="subtext">
							Register yourself to log in!
						</p>
					</li>
				</ul>

			</nav>

			<div id="content">

			</div>
			<footer>
				<p>
					abc
				</p>
				
				
				
			</footer>
		</div>

	</body>

</html>

