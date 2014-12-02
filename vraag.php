				<center>
		<?php
			require_once("includes/Vraag.class.php");
			require_once("includes/Pagination.class.php");
			require_once("includes/Shoppingcart.class.php");
			
			if($session->getLoggedIn())
			{
		
					
			
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
			
			
			if(isset($_GET['page']))
			{
				$page = $_GET['page'];	
			}
			
			else
			{
				//$page = 1;	
			}
			
			isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
			//$pagination = new Pagination_class($page, 3, Afspraak_class::count_all_records());
			
			
			 
			
				echo "<div class='item'>
					  <p class='kooi'>";
				
				
				echo "&nbsp;</p><br>
					  <form action='index.php?action=toevoeging' method='post'>
						  <input type='hidden' name='id' /><br>
						  Vraag: <br><input type='text' name='vraag' size='45' /><br><br>
						  <input type='submit' name='faq' value='Opslaan' /><br><br>
						  <br><br>
						  </div><br>
					  </form>";
			
			 
			 
			}
		?>
		<br />
			</center>