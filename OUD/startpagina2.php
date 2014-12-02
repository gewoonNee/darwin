<h2>24 uur per dag open!</h2>
<?php
	require_once("includes/Product.class.php");
	require_once("includes/Pagination.class.php");
	require_once("includes/Shoppingcart.class.php");
	$product_array = Product_class::find_all();
	
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];	
	}
	
	else
	{
		$page = 1;	
	}
	
	isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
	$pagination = new Pagination_class($page, 3, Product_class::count_all_records());
	
	if($pagination->hasPreviousPage())
	{
		echo "<a href='index.php?action=startpagina&page=".$pagination->previousPage()."'>&lt;&nbsp;</a>";
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
		 	echo"<a href='index.php?action=startpagina&page=".$i."'>".$i."</a>&nbsp;";
		 }
	 }
	 
	 if($pagination->hasNextPage())
	 {
	 	echo "<a href='index.php?action=startpagina&page=".$pagination->nextPage()."'>&gt;&nbsp;</a>";
	 }
	 
	 else
	{
		echo "<font color='#5077E0'>&gt;&nbsp;</font>";
	}
	 
	foreach(Product_class::find_all_limit_offset( $pagination->getRecords_per_page(), $pagination->offset()) as $product)
	{
		echo "<div class='item'>
			  <p class='kooi'>";
		
		if(isset ($_SESSION['cart']) && $_SESSION['cart']->inCart($product->getId()))
		{
			/*echo "<a href='index.php?action=shoppingcart&page=".$pagination->getCurrentPage()."&id=".$product->getId()."&do=add'><img src='pictures/kooiPlusOranje.png' title='Aantal in winkelwagen: ".$_SESSION['cart']->amountInCart($product->getId())."' /></a>";*/
		}
		
		else if(isset ($_SESSION['cart']))
		{
			/*echo "<a href='index.php?action=shoppingcart&page=".$pagination->getCurrentPage()."&id=".$product->getId()."&do=add'><img src='pictures/kooiPlus.png' title='Voeg toe aan winkelwagen' /></a>"; */
		}
		
		else
		{
			/*echo "<a href='index.php?action=loginform'><img src='pictures/kooiPlus.png' title='Voeg toe aan winkelwagen' /></a>";*/
		}
		
		echo "&nbsp;</p><br>
			  <strong><h3> ".$product->getProductnaam()." </h3></strong>
			  <img src='pictures/".$product->getFotonaam()."' /><br>
			  ".$product->getBeschrijving()."<br><br>
			  <strong>Categorie:</strong> ".$product->getCategorie()."<br>
			  <!--<strong>Prijs:</strong> <font color='#F90'>&euro;".$product->getPrijs().",00</font><br><br>-->";
			  if($product->getFilmpje())
			  {
				echo "<br><iframe width='300' height='225' src='//www.youtube.com/embed/".$product->getFilmpje()."' frameborder='0' allowfullscreen></iframe><br><br>";
			  }
			  if($session->getLoggedIn())
				{
					switch($_SESSION['user_rights'])
					{
						case "admin":
							echo "<br><a href='index.php?action=advies&auto=".$product->getId()."'><button type='button'>Advies start bod en laagste bod</button></a>";
							break;
						
						default:
							break;
					}
				}
			  echo "<br><br>
			  </div><br>";
	}
	
	if($pagination->hasPreviousPage())
	{
		echo "<a href='index.php?action=startpagina&page=".$pagination->previousPage()."'>&lt;&nbsp;</a>";
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
		 	echo"<a href='index.php?action=startpagina&page=".$i."'>".$i."</a>&nbsp;";
		 }
	 }
	 
	 if($pagination->hasNextPage())
	 {
	 	echo "<a href='index.php?action=startpagina&page=".$pagination->nextPage()."'>&gt;&nbsp;</a>";
	 }
	 
	 else
	{
		echo "<font color='#5077E0'>&gt;&nbsp;</font>";
	}
?>
<br />
