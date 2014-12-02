<?php 

	require_once('includes/VerkoperLogin.class.php');
	
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];	
	
		VerkoperLogin_class::deblokkeren($id);
		
		echo "Het account is gedeblokkeerd.";
		header('refresh:4;url=index.php?action=geblokkeerdeAccounts');
	}
	else
	{
		header('location:index.php?action=geblokkeerdeAccounts');
	}
	
?>