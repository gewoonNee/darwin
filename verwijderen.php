<?php 

	require_once('includes/Bestand.class.php');
	
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];	
	
		Bestand_class::delete($id);
		
		echo "Het bestand is verwijderd.";
		header('refresh:4;url=index.php?action=fotovideobeheer');
	}
	else
	{
		header('location:index.php?action=fotovideobeheer');
	}
	
?>