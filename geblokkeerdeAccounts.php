<?php 

	require_once('includes/VerkoperLogin.class.php');

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
	
	echo "<h2>Geblokkeerde accounts</h2>";
			
	$accounts = VerkoperLogin_class::find_geblokkeerd();
	
	echo "<table><th>Gebruikersnaam</th><th>Voornaam</th><th>Achternaam</th><th>E-mail</th><th>Deblokkeren</th>";

	foreach($accounts as $account)
	{
		echo "<tr><td>".$account->getUsername()."</td><td>".$account->getVoornaam()."</td><td>".$account->getAchternaam()."</td><td>".$account->getEmail()."</td>
		<td><a href='index.php?action=deblokkeren&id=".$account->getUsername()."'><button>Deblokkeren</button></a></td></tr>";
	}
	
	echo "</table>";
	
?>

<!--<h2>Foto/videobeheer</h2>
<table>
	<th>Datum</th><th>Locatie</th><th>Type</th><th>Titel</th><th>Verwijderen</th>
	<tr><td>02-11-2014</td><td>Home</td><td>Video</td><td>Museum rondleiding</td><td><button>Verwijderen</button></td></tr>
	<tr><td>01-11-2014</td><td>Contact</td><td>Foto</td><td>Voorkant museum</td><td><button>Verwijderen</button></td></tr>
</table>-->