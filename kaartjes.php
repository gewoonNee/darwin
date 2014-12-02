<h2>Kaartjes bestellen</h2>
<!--<p>
	<form>
	<table>
		<tr><td>Voornaam:</td> <td><input type='text' name='voornaam' /></td></tr>
		<tr><td>Achternaam:</td> <td><input type='text' name='achternaam' /></td></tr>
		<tr><td>Geboortedatum:</td> <td><input type='date' name='geboortedatum' /></td></tr>
		<tr><td>Postcode:</td> <td><input type='text' name='postcode' /></td></tr>
		<tr><td>Woonplaats:</td> <td><input type='text' name='woonplaats' /></td></tr>
		<tr><td>Datum bezoek:</td> <td><input type='date' name='datum' /></td></tr>
	</table>
	<br>
	<input type='submit' name='bestellen' value='Bestellen' />
	</form>
</p>-->

<center>
		<?php
						
			require_once("includes/Klant.class.php");
			require_once("includes/Reservering.class.php");
			require_once("includes/Provincie.class.php");
					
			if (isset($_POST['kaartje']))
			{
				if(empty($_POST['voornaam']) || empty($_POST['achternaam']) || empty($_POST['geboortedatum']) || empty($_POST['postcode']) ||
					empty($_POST['woonplaats']) || empty($_POST['provincie']) || empty($_POST['datum']))
				{
					echo "<br><br>Niet alle velden zijn ingevuld.";
					header("refresh:4");

				}
				elseif($_POST['geboortedatum'] > date('Y-m-d'))
				{
					echo "<br><br>Geboortedatum is ongeldig.";
					header('refresh:4');
				}
				elseif($_POST['datum'] < date('Y-m-d'))
				{
					echo "<br><br>Bezoekdatum is ongeldig.";
					header('refresh:4');
				}
				else
				{				
					Klant_class::add();
					$klantId = Klant_class::laatsteKlant()->getMaxId();
					$code = Reservering_class::laatsteCodes()->getMaxCode();
					$barcode = Reservering_class::laatsteCodes()->getMaxBarcode();
					
					$jaren = date_diff(date_create($_POST['geboortedatum']), date_create(date('Y-m-d')))->y;
					
					if($jaren < 12)
					{
						$prijs = 0;
					}
					elseif($jaren > 11 && $jaren < 18)
					{
						$prijs = 2.5;
					}
					elseif($jaren > 17 && $jaren < 60)
					{
						$prijs = 4;
					}
					elseif($jaren > 59)
					{
						$prijs = 2.5;
					}
					
					Reservering_class::add($klantId, date("Y-m-d"), ($code + 1), ($barcode + 1), $prijs);
					
					echo "<br><br>U heeft een kaartje besteld.";
					
					echo "<br><br><table><th>Voornaam</th><th>Achternaam</th><th>Geboortedatum</th><th>Postcode</th>
					      <tr><td>".$_POST['voornaam']."</td><td>".$_POST['achternaam']."</td><td>".$_POST['geboortedatum']."</td><td>".$_POST['postcode']."</td></tr>
						  <tr></tr>
						  <tr><td><strong>Code</strong></td><td><strong>Barcode</strong></td><td><strong>Prijs</strong></td></tr>
						  <tr><td>".($code + 1)."</td><td>".($barcode + 1)."</td><td>&#8364;".$prijs."</td></tr>
					      </table>
					      <br><br><input type='Button' value='Printen' name='printen' title='Printen' onclick='Javascript:window.print();' />";

					echo "<br><br><a href='index.php'><button>Terug naar het Darwin museum</button></a>";
					
					/*$from = new DateTime($_POST['geboortedatum']);
					$to   = new DateTime(date('Y-m-d'));
					echo $from->diff($to)->y;*/

				}
			}
			
			else 
			{
			
				$provincies = Provincie_class::find_all();
				
				echo "&nbsp;</p><br>
					  <form action='index.php?action=kaartjes' method='post'>
						  Voornaam: <br><input type='text' name='voornaam' /><br><br>
						  Achternaam: <br><input type='text' name='achternaam' /><br><br>
						  Geboortedatum: <br><input type='date' name='geboortedatum' /><br><br>
						  Postcode: <br><input type='text' name='postcode' /><br><br>
						  Woonplaats: <br><input type='text' name='woonplaats' /><br><br>
						  Provincie: <br><select name='provincie'>";
						  
						  foreach($provincies as $provincie)
						  {
							echo "<option value='".$provincie->getProvincieNaam()."'>".$provincie->getProvincieNaam()."</option>";
						  }
						  
				echo	  "</select><br><br>
						  Datum bezoek: <br><input type='date' name='datum' /><br><br>
						 
						  <input type='submit' name='kaartje' value='Bestellen' /><br><br>
						  <br><br>
						  </div><br>
					  </form>";
		    }
			
			 
			 
			
		?>
		<br />
	</center>