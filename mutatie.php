<?php
	require_once("includes/Session.class.php");
	require_once("includes/Product.class.php");
	
	if($session->getLoggedIn())
			{
		
					switch($_SESSION['user_rights'])
					{
						case "klant":
							header("location:index.php");
							break;
							
						default:
							break;
					}
			
			}
			
			else
			{
				header("location:index.php");
			}
	
	if(isset($_POST['submit']))
	{
			Product_class::edit();
	
	}


?>