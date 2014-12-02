<h1>Winkelwagen</h1>
<?php
	if($_SESSION['cart']->isEmpty())
	{
		echo "<br><br><br><img src='pictures/leeg2.png' />";	
	}
	
	else
	{
?>
<table class='winkelkooi'>
    <tr>
    	<th>Productnaam</th>
        <th>Foto</th>
        <th>Prijs</th>
        <th>Aantal</th>
        <th>Totaal</th>
    </tr>
    <?php
		foreach($_SESSION['cart']->getItems() as $value)
		{
			echo "<tr> <td width='80'>".$value['productnaam']."</td> <td width='80'><img src='pictures/".$value['fotonaam']."' /></td> <td width='80'>&euro;".$value['prijs']."</td> <td width='80'>".$value['aantal']."</td> <td width'80'>&euro;".$value['prijs'] * $value['aantal']."</td> <td width='50'></td> <td width='50'><a href='index.php?action=shoppingcart&id=".$value['id']."&do=plus'><h3>+<h3></a></td> <td width='50'>";
			if($value['aantal'] == 1)
			{
				echo "<a href='index.php?action=shoppingcart&id=".$value['id']."&do=minus' onclick='return confirm(\"Weet je zeker dat je dit item wil verwijderen?\")'><h2>-<h2></a></td> </tr>";
			}
			else
			{
				echo "<a href='index.php?action=shoppingcart&id=".$value['id']."&do=minus'><h2>-<h2></a></td> </tr>";
			}
		}
		
		echo "</table><hr width='70%'><table><tr><td width='200'></td> <td id='totaal'>&euro;".$_SESSION['cart']->totalPrice()."</td></tr>";
	?>
</table>
<br /><br />
<p class='clear'><a href='index.php?action=shoppingcart&do=clear' onclick='return confirm("Weet je zeker dat je alles wil verwijderen?")'>Clear</a></p>
<?php
	}
?>