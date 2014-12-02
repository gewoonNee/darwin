<?php
	require_once("includes/Session.class.php");
	require_once("includes/Product.class.php");
	require_once("includes/Afspraak.class.php");
	require_once("includes/Vraag.class.php");
	
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
			Product_class::add();
	
	}
	
	if(isset($_POST['afspraak']))
	{
			Afspraak_class::add();
	
	}
	
	if(isset($_POST['faq']))
	{
			Vraag_class::add();
	}
	
	if(isset($_POST['beantwoorden']))
	{
			Vraag_class::antwoord();
	}


?>