<?php error_reporting (E_ALL ^ E_STRICT) ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Veldkevers</title>
		<link rel='stylesheet' type='text/css' href='stylesheet/style.css' />
	</head>
	<body>
		<div id='container'>
			
			<div id='banner'>
				<?php include("banner.php"); ?>
			</div>
			
			<div id='links'><center>
					<?php 	include("includes/Shoppingcart.class.php");
							include("includes/Session.class.php");
							include("links.php"); ?>
			</center></div>
			
			<div id='content'>
				
				<center>
					<p><?php include("navigation.php"); ?><br>
                </center>
			</div>
			
			<div id='below'>
				<?php include("disclaymer.php"); ?><br>
			</div>
		</div>
	</body>
</html>