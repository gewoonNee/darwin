<?php

	/*if($session->getLoggedIn())
			{
		
					switch($_SESSION['user_rights'])
					{
						case "klant":
							header("location:index.php?action=betaling");
							break;
							
						default:
							break;
					}
			
			}
			
			else
			{
				header("location:index.php?action=loginformbank");
			}*/

?>

<div class='form'>
	<form action='?action=checkloginBank' method='post'>
        <table>
            <tr>
                <td>E-mailadres</td>
                <td><input type='text' name='em' /></td>
            </tr>
            <tr>
                <td>Wachtwoord</td>
                <td><input type='password' name='pw' /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td align='right'><input type='submit' name='submit' value='Inloggen' /></td>
            </tr>
        </table>
	</form>
</div>