<?php 

	require_once('includes/Bestand.class.php');

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
			
	echo "<h2>Foto/videobeheer</h2>";
			
	$bestanden = Bestand_class::find_all();
	
	echo "<table><th>Datum toevoeging</th><th>Naam</th><th>Bestandsnaam</th><th>Videolink</th><th>Verwijderen</th>";

	foreach($bestanden as $bestand)
	{
		echo "<tr><td>".$bestand->getDatumToevoeging()."</td><td>".$bestand->getNaam()."</td><td>".$bestand->getFotoNaam()."</td><td>".$bestand->getFilmpje()."</td>
		<td><a href='index.php?action=verwijderen&id=".$bestand->getId()."'><button>Verwijderen</button></a></td></tr>";
	}
	
	echo "</table>";
	
?>

<!--<h2>Foto/videobeheer</h2>
<table>
	<th>Datum</th><th>Locatie</th><th>Type</th><th>Titel</th><th>Verwijderen</th>
	<tr><td>02-11-2014</td><td>Home</td><td>Video</td><td>Museum rondleiding</td><td><button>Verwijderen</button></td></tr>
	<tr><td>01-11-2014</td><td>Contact</td><td>Foto</td><td>Voorkant museum</td><td><button>Verwijderen</button></td></tr>
</table>-->