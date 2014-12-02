<?php
	if (isset($_GET['action']))
		include($_GET['action'].".php");
	else
		include("startpagina.php");
?>