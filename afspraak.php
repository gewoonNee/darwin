				<center>
		<?php
			require_once("includes/Afspraak.class.php");
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
			$product_array = Afspraak_class::find_all();
			
			
			if(isset($_GET['page']))
			{
				$page = $_GET['page'];	
			}
			
			else
			{
				//$page = 1;	
			}
			
			isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
			$pagination = new Pagination_class($page, 3, Afspraak_class::count_all_records());
			
			
			 
			
				echo "<div class='item'>
					  <p class='kooi'>";
				
				$werknemers = Login_class::werknemer();
				
				echo "&nbsp;</p><br>
					  <form action='index.php?action=toevoeging' method='post'>
						  <input type='hidden' name='id' /><br>
						  Datum: <br><input type='date' name='datum' /><br><br>
						  Tijd: <br><input type='time' name='tijd' /><br><br>
						  Werknemer: <br>
						  <select name='werknemer'>
						  ";
						  
						  foreach($werknemers as $werknemer)
						  {
							echo "<option value='".$werknemer->getId()."'>".$werknemer->getUsername()."</option>";
						  }
			  echo 	"
						  </select><br><br>
						  Onderwerp: <br><input type='text' name='onderwerp' /><br><br>
						  <input type='submit' name='afspraak' value='Opslaan' /><br><br>
						  <br><br>
						  </div><br>
					  </form>";
			
			 
			 
			}
		?>
		<br />
			</center>