<h2>Openingstijden:</h2>
<?php
	require_once("includes/Product.class.php");
	require_once("includes/Pagination.class.php");
	require_once("includes/Shoppingcart.class.php");
	require_once("includes/Openingstijden.class.php");
	
	echo "<table>";
	
	foreach(Openingstijden_class::find_all() as $dag)
	{
		if($dag->getTijdOpeningUur() < 10)
		{
			$uurNul = 0;
		}
		else
		{
			$uurNul = null;
		}
		
		if($dag->getTijdOpeningMinuut() < 10)
		{
			$minuutNul = 0;
		}
		else
		{
			$minuutNul = null;
		}
		
		if($dag->getTijdSluitingUur() < 10)
		{
			$sluitingUurNul = 0;
		}
		else
		{
			$sluitingUurNul = null;
		}
		
		if($dag->getTijdSluitingMinuut() < 10)
		{
			$sluitingMinuutNul = 0;
		}
		else
		{
			$sluitingMinuutNul = null;
		}
		
		echo "<tr>
			  <td>".$dag->getDagNaam()."&nbsp;</td>
			  <td>$uurNul".$dag->getTijdOpeningUur().":$minuutNul".$dag->getTijdOpeningMinuut()."</td>
			  <td> - </td>
			  <td>$sluitingUurNul".$dag->getTijdSluitingUur().":$sluitingMinuutNul".$dag->getTijdSluitingMinuut()."</td>
			  </tr>";
	}
	
	echo "</table>";
	
	echo "<br><br>\"Zoogeography\" shows a variety of animals from different parts of the Earth, and explains the ways by which the fauna of our planet was formed.
		 <br><img src='pictures/collectie1.jpg' />
		 <br><br>\"The Stages of Nature Cognition\" illustrates a complicated way of Man's cognition of Natural laws. This gallery is unique in a sense that no other museum in the world has an entire gallery devoted to the history of development of scientific thought.
		 <br><img src='pictures/collectie2.jpg' />
		 <br><br>\"Macroevolution\" is devoted to the origin and development of life on the Earth from a molecule up to Man. You will learn who inhabited landscapes of distant geological epochs, who the deep ancestor of Man looked like, and how his evolution, as well as his relationship to Nature, has been developing at different times.
Here you will also discover ethology - a science about animal behaviour.
	     <br><img src='pictures/collectie3.jpg' />";
	
?>
<br />
