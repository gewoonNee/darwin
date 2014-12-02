				<center>
		<?php
			require_once("includes/Vraag.class.php");
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
			$product_array = Vraag_class::find_all_geenantwoord();
			
			
			if(isset($_GET['page']))
			{
				$page = $_GET['page'];	
			}
			
			else
			{
				//$page = 1;	
			}
			
			isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
			//$pagination = new Pagination_class($page, 3, Product_class::count_all_records());
			
			
			 
	
	
	
	
				foreach(Vraag_class::find_all_geenantwoord( ) as $vraag)
				{
					echo "<div class='item'>
						 <p class='kooi'>
						 <p><strong>".$vraag->getVraag()."</strong><br><br>
						 <form action='index.php?action=toevoeging' method='post'>
						 <input type='hidden' name='id' value='".$vraag->getId()."' />
						 Antwoord:<br><input type='text' name='antwoord' size='45' /><br><br><br>
						 <input type='submit' name='beantwoorden' /><br><br>
						 </form></p>
						 </div>";
				}

				if(!Vraag_class::find_all_geenantwoord())
				{
					echo "<br><br>Er zijn geen onbeantwoorde vragen.";
				}


				
			
			 
			 
			}
		?>
		<br />
			</center>