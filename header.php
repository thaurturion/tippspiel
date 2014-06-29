<?php
session_start();
?>


<div id="logo">
	<img src="images/logo.jpg" />
</div>

<span id="desc"><a href="#"><h2>WM-Tippspiel</h2></a></span>

<?php
if(isset($_SESSION["login"]) && $_SESSION["login"] == 1){
?>
<div id ="login">
	<a href="#" onclick="jQuery('#content').load('logout.php')">Logout</a>
</div>
<?php
} else {
?>
<div id ="login">
	<a href="#" onclick="jQuery('#content').load('login.php')">Login</a>
</div>
<?php
}
?>


