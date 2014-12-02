<?php
	require_once("includes/VerkoperLogin.class.php");
	require_once("includes/VerkoperLog.class.php");
	require_once("includes/Session.class.php");
	require_once("includes/Shoppingcart.class.php");
	
	if(isset($_POST['submit']))
	{
		if (!empty($_POST['em']) && !empty($_POST['pw']))
		{
			if(VerkoperLogin_class::check_if_email_password_exists($_POST))
			{
				if(VerkoperLogin_class::byUsername($_POST['em'])->getGeblokkeerd() == 0)
				{
					$session->login(VerkoperLogin_class::find_by_email_password($_POST));
					
					$_SESSION['rights'] = $user[0]['Rights']['rights'];
					$_SESSION['username'] = $_POST['em'];
					
					$voornaam = VerkoperLogin_class::byUsername($_SESSION['username'])->getVoornaam();
					$achternaam = VerkoperLogin_class::byUsername($_SESSION['username'])->getAchternaam();
					$email = VerkoperLogin_class::byUsername($_SESSION['username'])->getEmail();
				
					VerkoperLog_class::add($_SESSION['username'], $voornaam, $achternaam, $email, date('Y-m-d H:i:s'), 0);
					
					switch(VerkoperLogin_class::get_rights($_POST))
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
							
						case "verkoper":
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
					echo "Dit account is geblokkeerd.";
					header('refresh:4;url=index.php?action=verkoperlogin');
				}
			
			}
			
			else
			{
				if(VerkoperLogin_class::byUsername($_POST['em'])->getGeblokkeerd() == 1)
				{
					echo "Dit account is geblokkeerd.";
					header('refresh:4;url=index.php?action=verkoperlogin');
				}
				else
				{
					$username = $_POST['em'];
				
					$aantal = VerkoperLogin_class::byUsername($username)->getInlogFout();
					VerkoperLogin_class::updateInlogFout($aantal, $username);
					
					$voornaam = VerkoperLogin_class::byUsername($username)->getVoornaam();
					$achternaam = VerkoperLogin_class::byUsername($username)->getAchternaam();
					$email = VerkoperLogin_class::byUsername($username)->getEmail();
				
					VerkoperLog_class::add($username, $voornaam, $achternaam, $email, date('Y-m-d H:i:s'), 1);
				
					if($aantal > 1)
					{
						VerkoperLogin_class::blokkeren($username);
						echo "Gebruikersnaam of wachtwoord onjuist. Het account is geblokkeerd.";
						header('refresh:4;url=index.php');

					}
					else
					{
						echo "Gebruikersnaam of wachtwoord onjuist.";
						header('refresh:4;url=index.php?action=verkoperlogin');
					}
				}
				
			}
		}
		
		else
		{
			echo "Niet alle velden zijn ingevuld.";
			header('refresh:4;url=index.php?action=verkoperlogin');	
		}
	}
?>