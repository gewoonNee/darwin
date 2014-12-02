<?php
	
	require_once("includes/Bestand.class.php");
	
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
		
	echo "<h2>Uploaden</h2>";
		
	if(isset($_POST['submit']))
	{
		Bestand_class::add(date('Y-m-d H:i:s'));
		
		echo "Het bestand is toegevoegd.";
	}

	else
	{
		echo "&nbsp;</p><br>
						  <form action='index.php?action=uploaden' method='post' enctype='multipart/form-data'>
							  <input type='hidden' name='id' /><br>
							  Naam: <br><input type='text' name='naam' /><br><br>
							  Bestandsnaam: <br><input type='file' name='fotonaam' /><br><br>
							  Videolink: <br><input type='text' name='filmpje' /><br><br>
							  <input type='submit' name='submit' value='Opslaan' /><br><br>
							  <br><br>
							  </div><br>
						  </form>";
	}

?>

<!--<h2>Uploaden</h2>
<button>Selecteer foto/video</button><br><br>
Titel: <input type='text' /><br><br>
Locatie: 
<select>
<option>Home</option>
<option>PLattegrond</option>
<option>Contact</option>
</select>-->