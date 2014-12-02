<?php
	if (isset($_POST['submit']))
	{
		require_once("includes/MySQLDatabase.class.php");
		require_once("includes/User.class.php");
		require_once("includes/Login.class.php");
		//$result = $database->fire_query("SELECT * FROM `user`");
		
		/*$users = User_class::find_by_sql("SELECT * from `user`");
		
		foreach($users as $user)
		{
			echo $user->getId()."<br />";
		}*/
		if(Login_class::emailadress_exists($_POST['username']))
		{
			echo "E-mailadres is bezet.";
			header("refresh:6;url=index.php?content=register");
		}
		
		else
		{
			User_class::insert_into_user($_POST);
			echo "Geregisteerd.";
			header("refresh:4;url=index.php");
		}
	}
	else
	{
?>

<div class='form'>
	<form action='index.php?action=register' method='post'>
		<table border='0'>
			<tr>
				<td>Gebruikersnaam</td>
				<td><input tabindex='1' type='text' name='username' /></td>
			</tr>
			<tr>
				<td>Wachtwoord</td>
				<td><input tabindex='2' type='password' name='password' /></td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
				<td align='right'><input tabindex='3' type='submit' name='submit' value='Registreer' /></td>
			</tr>
		</table>
	</form>
</div
<?php
	}
?>