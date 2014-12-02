<?php require_once("includes/Login.class.php"); ?>


	<div><a href='index.php' class='link'>Home</a>

    <?php
		if($session->getLoggedIn())
		{
			/*echo"<li><a href='index.php?action=winkelwagen'>Winkelwagen</a></li>";	*/
					switch($_SESSION['user_rights'])
					{
						case "admin":
							/*echo "<a href='index.php?action=toevoegen' class='link'>Toevoegen</a>";
							echo "<a href='index.php?action=muteren' class='link'>Muteren</a>";
							echo "<a href='index.php?action=afspraakOverzicht' class='link'>Afspraak overzicht</a>";
							echo "<a href='index.php?action=antwoorden' class='link'>Vragen beantwoorden</a>";*/
							echo "<a href='index.php?action=uploaden' class='link'>Uploaden</a>";
							echo "<a href='index.php?action=fotovideobeheer' class='link'>Foto/videobeheer</a>";
							echo "<a href='index.php?action=geblokkeerdeAccounts' class='link'>Geblokkeerde accounts</a>";
							echo "<a href='index.php?action=logbestand' class='link'>Logbestand</a>";
							break;
							
						/*case "klant":
							echo "<a href='index.php?action=afspraak' class='link'>Afspraak maken</a>";
							echo "<a href='index.php?action=faq' class='link'>FAQ</a>";
							echo "<a href='index.php?action=plattegrond' class='link'>Plattegrond</a>";
							echo "<a href='index.php?action=contact' class='link'>Contact</a>";
							break;*/
							
						case "klant":
							echo "<a href='index.php?action=overzichten' class='link'>Overzichten</a>";
							break;
							
						case "verkoper":
							echo "<a href='index.php?action=kaartjesprinten' class='link'>Kaartjes printen</a>";
						
						default:
							break;
					}
			
			echo"<a href='index.php?action=logout' class='link'>Uitloggen</a>";
		}
		else
		{
			/*echo "<a href='index.php?action=loginform' class='link'>Inloggen</a>";
			echo "<a href='index.php?action=register' class='link'>Registreren</a>";*/
			echo "<a href='index.php?action=plattegrond' class='link'>Plattegrond</a>";
			echo "<a href='index.php?action=contact' class='link'>Contact</a>";
			echo "<a href='index.php?action=kaartjes' class='link'>Kaartjes bestellen</a>";
			
		}
	?>
	</div>