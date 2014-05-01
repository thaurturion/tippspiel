<?php
	session_start();
?>

&copy; Fabian Bode, Manuel Digeser and Marc Kaltenbach <?php
if(isset($_SESSION["login"]) && $_SESSION["login"] == 1){
?>
	<a href="#" onclick="loadAdmin();">Admin</a></div>
	
<?php
}
?>