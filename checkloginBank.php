<?php
	require_once("includes/Banklogin.class.php");
	require_once("includes/Session.class.php");
	require_once("includes/Shoppingcart.class.php");
	
	if(isset($_POST['submit']))
	{
		if (!empty($_POST['em']) && !empty($_POST['pw']))
		{
			if(Banklogin_class::check_if_email_password_exists($_POST))
			{
					$session->login(Banklogin_class::find_by_email_password($_POST));
					
					$_SESSION['rights'] = $user[0]['Rights']['rights'];
					$_SESSION['username'] = $_POST['em'];
					
					switch(Banklogin_class::get_rights($_POST))
					{
						case "klant":
							if(!isset ($_SESSION['cart']))
							{
								$_SESSION['cart'] = new Shoppingcart_class();
								$_SESSION['cart']->getSavedCart();
								
							}
							header("location:index.php?action=betaling");
							
							break;
						
						/*case "admin":
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
							
							break;*/
							
							
						default:
						
							break;
					}
				
			}
			
			else
			{
				echo "Gebruikersnaam of wachtwoord onjuist.";
				header('refresh:4;url=index.php?action=loginformbank');
			}
		}
		
		else
		{
			echo "Niet alle velden zijn ingevuld.";
			header('refresh:4;url=index.php?action=loginformbank');	
		}
	}
?>