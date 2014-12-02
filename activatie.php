<?php
	require_once("includes/Login.class.php");
	if(isset ($_POST['submit']))
	{
		//if(strcmp($_POST['password'], $_POST['passwordCheck']))
		if ($_POST['password'] == $_POST['passwordCheck'])
		{
			Login_class::update_password($_POST);
			header('refresh:2;url=index.php');
		}
		
		else
		{
			echo "Wachtwoorden niet hetzelfde<br>";
			header('refresh:6;url=index.php?action=activatie&email='.$_POST['email'].'&password='.$_POST['password'].'');
		}
	}
	
	else if (isset($_GET['em']) && isset($_GET['pw']))
	{
	
	$user = Login_class::find_by_email_password($_GET);
	if($user != null)
	{
		//Login_class::activate_account($_GET);
?>

<h2>Inloggen</h2>
<p>Dit is een site</p>
<form method='post' action='index.php?action=activatie'>
	Wachtwoord:<br>
    <input type='password' name='password' size='24' maxlength='24' /><br><br>
    Wachtwoord opnieuw:<br>
  <input name='passwordCheck' type='password' size='24' maxlength='24' src="includes/untitled.jpg" /><br><br>
    <input type='submit' value='Deze knop wordt gesponsord door perzikenpudding.' name='submit'/><br><br>
	<input type='reset' value='Deze knop is incomple' /><br><br>
    <input type='hidden' name='em' value='<?php echo $user->getUsername(); ?>' />
    <input type='hidden' name='pw' value='<?php echo $user->getPassword() ?>' />
</form>
<?php
	}
	}
	else
	{
		header('location:index.php');	
	}
?>