				<center>
		<?php
			require_once("includes/Product.class.php");
			require_once("includes/Pagination.class.php");
			require_once("includes/Shoppingcart.class.php");
			
			if($session->getLoggedIn())
			{
		
					switch($_SESSION['user_rights'])
					{
						case "klant":
							header("location:index.php");
							break;
							
						default:
							break;
					}
			
			}
			
			else
			{
				header("location:index.php");
			}
			
			if (isset($_POST['submit']))
			{
				echo "Submit";
			}
			else
			{
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
				echo "<a href='index.php?action=muteren&page=".$pagination->previousPage()."'>&lt;&nbsp;</a>";
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
					echo"<a href='index.php?action=muteren&page=".$i."'>".$i."</a>&nbsp;";
				 }
			 }
			 
			 if($pagination->hasNextPage())
			 {
				echo "<a href='index.php?action=muteren&page=".$pagination->nextPage()."'>&gt;&nbsp;</a>";
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
					//echo "<a href='index.php?action=shoppingcart&page=".$pagination->getCurrentPage()."&id=".$product->getId()."&do=add'><img src='pictures/kooiPlusOranje.png' title='Aantal in winkelwagen: ".$_SESSION['cart']->amountInCart($product->getId())."' /></a>";
				}
				
				else if(isset ($_SESSION['cart']))
				{
					//echo "<a href='index.php?action=shoppingcart&page=".$pagination->getCurrentPage()."&id=".$product->getId()."&do=add'><img src='pictures/kooiPlus.png' title='Voeg toe aan winkelwagen' /></a>";
				}
				
				else
				{
					//echo "<a href='index.php?action=loginform'><img src='pictures/kooiPlus.png' title='Voeg toe aan winkelwagen' /></a>";
				}
				
				echo "&nbsp;</p><br>
					  <form action='index.php?action=mutatie' method='post'>
						  <input type='hidden' name='id' value='".$product->getId()."' /><br>
						  Autonaam: <br><input type='text' name='productnaam' value='".$product->getProductnaam()."' /><br><br>
						  Fotonaam: <br><input type='text' name='fotonaam' value='".$product->getFotonaam()."' /><br><br>
						  Beschrijving: <br><input type='text' name='beschrijving' value='".$product->getBeschrijving()."' size='45' /><br><br>
						  Categorie: <br><input type='text' name='categorie' value='".$product->getCategorie()."' /><br><br>
						  Prijs: <br><input type='text' name='prijs' value='".$product->getPrijs()."' size='8' /><br><br>
						  Aankoopdatum: <br><input type='date' name='datum' value='".$product->getAankoop()."' /><br><br>
						  <input type='submit' name='submit' value='Opslaan' /><br><br>
						  <br><br>
						  </div><br>
					  </form>";
			}
			
			if($pagination->hasPreviousPage())
			{
				echo "<a href='index.php?action=muteren&page=".$pagination->previousPage()."'>&lt;&nbsp;</a>";
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
					echo"<a href='index.php?action=muteren&page=".$i."'>".$i."</a>&nbsp;";
				 }
			 }
			 
			 if($pagination->hasNextPage())
			 {
				echo "<a href='index.php?action=muteren&page=".$pagination->nextPage()."'>&gt;&nbsp;</a>";
			 }
			 
			 else
			{
				echo "<font color='#5077E0'>&gt;&nbsp;</font>";
			}
			}
		?>
		<br />
			</center>