<?php
	require_once("includes/Login.class.php");
	require_once("includes/Session.class.php");
	require_once("includes/Shoppingcart.class.php");
	require_once("includes/Log.class.php");
	
	if(isset($_POST['submit']))
	{
		if (!empty($_POST['em']) && !empty($_POST['pw']))
		{
			if(Login_class::check_if_email_password_exists($_POST))
			{
					$session->login(Login_class::find_by_email_password($_POST));
					
					$_SESSION['rights'] = $user[0]['Rights']['rights'];
					$_SESSION['username'] = $_POST['em'];
					
					Log_class::add($_SESSION['user_id'], date('Y-m-d H:i:s'), 0);
					
					switch(Login_class::get_rights($_POST))
					{
						case "klant":
							if(!isset ($_SESSION['cart']))
							{
								$_SESSION['cart'] = new Shoppingcart_class();
								$_SESSION['cart']->getSavedCart();
								
							}
							header("location:index.php?");
							
							break;
						
						case "admin":
							if(!isset ($_SESSION['cart']))
							{
								$_SESSION['cart'] = new Shoppingcart_class();
								$_SESSION['cart']->getSavedCart();
								
							}
							header("location:index.php?");
							
							break;
						
						case "beheerder":
							if(!isset ($_SESSION['cart']))
							{
								$_SESSION['cart'] = new Shoppingcart_class();
								$_SESSION['cart']->getSavedCart();
								
							}
							header("location:index.php?action=beheerder");
							
							break;
							
						default:
						
							break;
					}
				
			}
			
			else
			{
				echo "Gebruikersnaam of wachtwoord onjuist.";
				header('refresh:4;url=index.php?action=loginform');
			}
		}
		
		else
		{
			echo "Niet alle velden zijn ingevuld.";
			header('refresh:4;url=index.php?action=loginform');	
		}
	}
?>