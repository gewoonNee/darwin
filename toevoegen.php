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
				//$page = 1;	
			}
			
			isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
			$pagination = new Pagination_class($page, 3, Product_class::count_all_records());
			
			
			 
			
				echo "<div class='item'>
					  <p class='kooi'>";
				
				
				
				echo "&nbsp;</p><br>
					  <form action='index.php?action=toevoeging' method='post' enctype='multipart/form-data'>
						  <input type='hidden' name='id' /><br>
						  Autonaam: <br><input type='text' name='productnaam' value='Auto' /><br><br>
						  Fotonaam: <br><input type='file' name='fotonaam' /><br><br>
						  Beschrijving: <br><input type='text' name='beschrijving' size='45' /><br><br>
						  Categorie: <br><input type='text' name='categorie' value='Personenwagen' /><br><br>
						  Prijs: <br><input type='text' name='prijs' value='' size='8' /><br><br>
						  Aankoopdatum: <br><input type='date' name='datum' /><br><br>
						  <input type='submit' name='submit' value='Opslaan' /><br><br>
						  <br><br>
						  </div><br>
					  </form>";
			
			 
			 
			}
		?>
		<br />
			</center>