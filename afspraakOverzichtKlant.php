<h3><a href='index.php?action=afspraakOverzicht'>Sorteer op datum</a></h3>

<?php
	require_once("includes/Afspraak.class.php");
	require_once("includes/Pagination.class.php");
	require_once("includes/Shoppingcart.class.php");
	require_once("includes/Login.class.php");
	
	$product_array = Afspraak_class::find_all();
	
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];	
	}
	
	else
	{
		$page = 1;	
	}
	
	isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
	$pagination = new Pagination_class($page, 3, Afspraak_class::count_all_records_future($_SESSION['user_id']));
	
	if($pagination->hasPreviousPage())
	{
		echo "<a href='index.php?action=afspraakOverzicht&page=".$pagination->previousPage()."'>&lt;&nbsp;</a>";
	}
	
	else
	{
		echo "<font color='#5077E0'>&lt;&nbsp;</font>";
	}
	
	 for($i = 1; $i <= $pagination->totalPages(); $i++)
	 {
		 
		 if($i == $pagination->getCurrentPage())
		 {
		  	echo"<font color='#F90'>".$i."</font>&nbsp;";
		 }
		 
		 else
		 {
		 	echo"<a href='index.php?action=afspraakOverzicht&page=".$i."'>".$i."</a>&nbsp;";
		 }
	 }
	 
	 if($pagination->hasNextPage())
	 {
	 	echo "<a href='index.php?action=afspraakOverzicht&page=".$pagination->nextPage()."'>&gt;&nbsp;</a>";
	 }
	 
	 else
	{
		echo "<font color='#666666'>&gt;&nbsp;</font>";
	}
	 
	foreach(Afspraak_class::find_all_limit_offset_klant( $pagination->getRecords_per_page(), $pagination->offset(), $_SESSION['user_id']) as $product)
	{
		echo "<div class='item'>
			  <p class='kooi'>";
		
		$tijd = strtotime($product->getTijd());
		$datum = strtotime($product->getDatum());
		
		echo "&nbsp;</p><br><br><table>
			  <tr><td>Datum:</td><td>".date('d-m-Y', $datum)."</td></tr>
			  <tr><td>&nbsp;</td></tr>
			  <tr><td>Begintijd:</td><td>".date('H:i', $tijd)."</td></tr>
			  <tr><td>&nbsp;</td></tr>
			  <tr><td>Eindtijd:</td><td>".date('H:i', strtotime('+20 minutes', $tijd))."</td></tr>
			  <tr><td>&nbsp;</td></tr>
			  <tr><td>Werknemer:</td><td>".Login_class::klantnaam($product->getWerknemer())->getUsername()."</td></tr>
			  <tr><td>&nbsp;</td></tr>
			  <tr><td>Klant:</td><td>".Login_class::klantnaam($product->getKlant())->getUsername()."</td></tr>
			  </table><br><br>
			  Onderwerp:<br><br>".$product->getOnderwerp()."<br><br><br>
			  </div><br>";
	}
	
	if($pagination->hasPreviousPage())
	{
		echo "<a href='index.php?action=afspraakOverzicht&page=".$pagination->previousPage()."'>&lt;&nbsp;</a>";
	}
	
	else
	{
		echo "<font color='#5077E0'>&lt;&nbsp;</font>";
	}
	
	 for($i = 1; $i <= $pagination->totalPages(); $i++)
	 {
		 if($i == $pagination->getCurrentPage())
		 {
		  	echo"<font color='#F90'>".$i."</font>&nbsp;";
		 }
		 
		 else
		 {
		 	echo"<a href='index.php?action=afspraakOverzicht&page=".$i."'>".$i."</a>&nbsp;";
		 }
	 }
	 
	 if($pagination->hasNextPage())
	 {
	 	echo "<a href='index.php?action=afspraakOverzicht&page=".$pagination->nextPage()."'>&gt;&nbsp;</a>";
	 }
	 
	 else
	{
		echo "<font color='#5077E0'>&gt;&nbsp;</font>";
	}
?>
<br />
