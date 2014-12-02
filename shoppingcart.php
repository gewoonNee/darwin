<?php
	require_once("includes/Product.class.php");
	require_once("includes/Shoppingcart.class.php");
	
	
	switch ($_GET['do'])
	{
		case 'add':
			
			$_SESSION['cart']->addToCart(Product_class::find_by_id($_GET['id']), 1);
			Header("Location:index.php?action=startpagina");
			break;
			
		case 'plus':
			
			$_SESSION['cart']->addToCart(Product_class::find_by_id($_GET['id']), 1);
			Header("Location:index.php?action=winkelwagen");
			break;
		
		case 'minus':
		
			$_SESSION['cart']->removeFromCart(Product_class::find_by_id($_GET['id']), 1);
			Header("Location:index.php?action=winkelwagen");
			break;
		
		case 'clear':
			
			$_SESSION['cart']->clearcart();
			Header("Location:index.php?action=winkelwagen");
			
			break;
		default:
		
			break;	
	}
?>