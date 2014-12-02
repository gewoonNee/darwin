<?php
	require_once("includes/Product.class.php");
	$product_array = Product_class::find_all();
	
	if(isset($_GET['auto']))
	{
		$auto = $_GET['auto'];	
	}
	
	else
	{
		$auto = 1;	
	}
	
	foreach(Product_class::find_auto( $auto) as $product)
	{
		echo "<div class='item'>
			  <p class='kooi'>";
		
		
		$aankoop = date('d-m-Y', strtotime($product->getAankoop()));
		$vandaag = date('d-m-Y');
		
		$date1 = date_create($vandaag);
		$date2 = date_create($aankoop);
		//$interval = date_diff($date1, $date2);
		$interval = $date2->diff($date1);
		$difference = (($interval->format('%y') * 12) + $interval->format('%m'));
		$inkoopprijs = $product->getPrijs();
		
		if($aankoop == $vandaag)
		{
			$startbod = 2.2 * $inkoopprijs;
			$laagstebod = 2.2 * $inkoopprijs;
		}
		
		elseif($difference < 3)
		{
			$startbod = 2 * $inkoopprijs;
			$laagstebod = 1.4 * $inkoopprijs;
			
		}
		
		elseif($difference >= 3 && $difference < 6)
		{
			$startbod = 1.8 * $inkoopprijs;
			$laagstebod = 1.3 * $inkoopprijs;
		}
		
		elseif($difference >= 6 && $difference < 12)
		{
			$startbod = 1.4 * $inkoopprijs;
			$laagstebod = 1.1 * $inkoopprijs;
		}
		
		else
		{
			$startbod = 1.3 * $inkoopprijs;
			$laagstebod = 1 * $inkoopprijs;
		}
		
		if($difference != 1)
		{
			$maanden = $difference." maanden geleden";
		}
		
		else
		{
			$maanden = $difference." maand geleden";
		}
		
		
		echo "&nbsp;</p><br>
			  <strong><h3> ".$product->getProductnaam()." </h3></strong>
			  <img src='pictures/".$product->getFotonaam()."' /><br>
			  ".$product->getBeschrijving()."<br><br>
			  <strong>Aankoopdatum:</strong> ".$aankoop."<br>
			  ".$maanden."<br><br>
			  <strong>Inkoopprijs:</strong> €".number_format($inkoopprijs, 0, '', '.')."<br><br>
			  <strong>Start bod:</strong> €".number_format($startbod, 0, '', '.')."<br>
			  <strong>Laagste bod</strong> €".number_format($laagstebod, 0, '', '.')."<br>
			  
			  <br><br>
			  </div><br>";
	}
	
?>
<br />
