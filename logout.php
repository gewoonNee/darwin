<?php
	$session->logout();
	//session_destroy();
	echo "<div class='form'>Je bent nu uitgelogd.</div>";
	header("refresh:2;url=index.php");
?>