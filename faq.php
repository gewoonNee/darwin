<?php 
	
	require_once("includes/Vraag.class.php");
	
	
	
	foreach(Vraag_class::find_all( ) as $vraag)
	{
		echo "<p><strong>".$vraag->getVraag()."</strong><br><br>
			 ".$vraag->getAntwoord()."<br><br><br></p>";
	}

?>

<br><h2><a href='index.php?action=vraag'>Stel een vraag</a></h2><br><br>