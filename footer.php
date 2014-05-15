<?php
	session_start();
?>

&copy; Fabian Bode, Manuel Digeser and Marc Kaltenbach <?php
if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1 ){
?>
	<a href="#" onclick="loadAdmin();">Admin</a></div>
	
<?php
}
?>
<a href="#">Impressum</a>