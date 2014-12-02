<center>

<h2>Bezoekers</h2>
		<?php
						
			require_once("includes/Klant.class.php");
			require_once("includes/Reservering.class.php");
					
					
			$dagen = Reservering_class::perDag(date("Y-m-d"));
			$weken = Reservering_class::perWeek(date("Y-m-d"), date("Y-m-d",strtotime("-7 days")));
			$maanden = Reservering_class::perWeek(date("Y-m-d"), date("Y-m-d",strtotime("-3 months")));
			$reserveringen = Reservering_class::reserveringen(date("Y-m-d"));
			
			$aantalKlanten = Klant_class::countKlanten(date("Y-m-d"), date("Y-m-d",strtotime("-7 days")))->getCountAll();
			$aantalKlantenProvincie = Klant_class::countKlantenProvincie(date("Y-m-d"), date("Y-m-d",strtotime("-7 days")))->getCountProvincie();
			
			$aantalKlantenJaar = Klant_class::countKlantenJaar(date("Y-m-d"), date("Y-m-d",strtotime("-1 year")))->getCountAll();
			$aantalKlantenProvincieJaar = Klant_class::countKlantenProvincieJaar(date("Y-m-d"), date("Y-m-d",strtotime("-7 year")))->getCountProvincie();
			
			echo "<p><table><th>Vandaag</th><th>&nbsp;&nbsp;&nbsp;Bezoekers</th>";
			
			foreach($dagen as $dag)
			{
				echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".date('d-m-Y')."</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dag->getAantal()."</td></tr>";
			}
			 
			 
			 
			 echo "<th>Afgelopen week</th><th>&nbsp;&nbsp;&nbsp;Bezoekers</th>";
			
			foreach($weken as $week)
			{
				echo "<tr><td>".date("d-m-Y",strtotime("-7 days"))."/".date("d-m-Y")."</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$week->getAantal()."</td></tr>";
			}
			 
			
			 
			 echo "<th>Afgelopen 3 maanden</th><th>&nbsp;&nbsp;&nbsp;Bezoekers</th>";
			
			foreach($maanden as $maand)
			{
				echo "<tr><td>".date("d-m-Y",strtotime("-3 months"))."/".date("d-m-Y")."</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$week->getAantal()."</td></tr>";
			}
			 
			echo "</table></p><h2>Reserveringen</h2>";
			 
			 echo "<p><table><th>Vandaag</th><th>&nbsp;&nbsp;&nbsp;Reserveringen</th>";
			 
			 foreach($reserveringen as $reservering)
			{
				echo "<tr><td>".date('d-m-Y')."</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$reservering->getAantal()."</td></tr>";
			}
			 
			 echo "</table></p><h2>Bezoekers uit eigen provincie (streefpercentage 45%)</h2>";
			 
			 
			 echo "<p><table><th>Afgelopen week</th><th>&nbsp;&nbsp;&nbsp;&nbsp;Bezoekers</th><th>&nbsp;&nbsp;Percentage</th>
				   <tr><td>".date("d-m-Y",strtotime("-7 days"))."/".date("d-m-Y")."</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$aantalKlantenProvincie."/".$aantalKlanten."</td>
				   <td>&nbsp;&nbsp;&nbsp;&nbsp;".number_format(($aantalKlantenProvincie / $aantalKlanten) * 100, 2, ',', '')."%</td></tr>
				   </table>";
				   
				   
		    echo "<table><th>Afgelopen jaar</th><th>&nbsp;&nbsp;&nbsp;&nbsp;Bezoekers</th><th>&nbsp;&nbsp;Percentage</th>
				   <tr><td>".date("d-m-Y",strtotime("-1 year"))."/".date("d-m-Y")."</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$aantalKlantenProvincieJaar."/".$aantalKlantenJaar."</td>
				   <td>&nbsp;&nbsp;&nbsp;&nbsp;".number_format(($aantalKlantenProvincieJaar / $aantalKlantenJaar) * 100, 2, ',', '')."%</td></tr>
				   </table></p>";
				   
			
		?>
		<br />
	</center>