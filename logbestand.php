<?php 

	require_once('includes/VerkoperLog.class.php');

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
	
	if(isset($_GET['download']))
	{
		$filename = "Logbestand_verkopers_" . date('Ymd') . ".xls";

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
	}
	
	echo "<h2>Logbestand verkopers</h2>";
			
	$logVerkopers = VerkoperLog_class::find_all();
	
	echo "<table><th>Datum inloggen</th><th>Gebruikersnaam</th><th>Voornaam</th><th>Achternaam</th><th>E-mail</th>";

	foreach($logVerkopers as $log)
	{
		echo "<tr><td>".$log->getDatumTijd()."</td><td>".$log->getUsername()."</td><td>".$log->getVoornaam()."</td><td>".$log->getAchternaam()."</td>
		<td>".$log->getEmail()."</td></tr>";
	}
	
	echo "</table>";
	
	echo "<br><a href='index.php?action=logbestand&download=excel'><button>Gegevens downloaden in Excel</button></a><br><br>";
	
	
?>

<!--<h2>Foto/videobeheer</h2>
<table>
	<th>Datum</th><th>Locatie</th><th>Type</th><th>Titel</th><th>Verwijderen</th>
	<tr><td>02-11-2014</td><td>Home</td><td>Video</td><td>Museum rondleiding</td><td><button>Verwijderen</button></td></tr>
	<tr><td>01-11-2014</td><td>Contact</td><td>Foto</td><td>Voorkant museum</td><td><button>Verwijderen</button></td></tr>
</table>-->