--TEST--
Test find_all()
--FILE--
<?php
        $query = "SELECT id, username, password, rights, voornaam, achternaam, email, geblokkeerd, inlogFout
					  FROM `verkoper`";	
		return self::find_by_sql($query);
?>
--EXPECT--
"1, verkoper, verkoper, verkoper, Verkoper, Een, verkoper@verkoper.nl, 0, 0"
"2, verkoper2, verkoper, verkoper, Verkoper, Twee, verkoper2@verkoper.nl, 0, 0"
"3, verkoper3, verkoper, verkoper, Verkoper, Drie, verkoper3@verkoper.nl, 1, 3"
"4, verkoper4, verkoper, verkoper, Verkoper, Vier, verkoper4@verkoper.nl, 1, 3"


--TEST--
Test find_geblokkeerd()
--FILE--
<?php
        $query = "SELECT id, username, password, rights, voornaam, achternaam, email, geblokkeerd, inlogFout
					  FROM `verkoper` WHERE geblokkeerd = '1'";	
		return self::find_by_sql($query);
?>
--EXPECT--
"3, verkoper3, verkoper, verkoper, Verkoper, Drie, verkoper3@verkoper.nl, 1, 3"
"4, verkoper4, verkoper, verkoper, Verkoper, Vier, verkoper4@verkoper.nl, 1, 3"


--TEST--
Test emailadress_exists()
--FILE--
<?php
        global $database;
			$query = "SELECT * FROM `verkoper` WHERE `username` = '".$email."'";
			$result = $database->fire_query($query);
			if(mysqli_num_rows($result) > 0 )
			{
				return true;
			}
			else
			{
				return false;	
			}
?>
--EXPECT--
true


--TEST--
Test find_by_email_password()
--FILE--
<?php
        public static function find_by_email_password($array)
		{
			$query = "SELECT * FROM `verkoper` WHERE `username` = '".$array['em']."' && `password` = '".$array['pw']."' ";	
			$login_data = self::find_by_sql($query);
			return array_shift($login_data);
		}
?>
--EXPECT--
"2, verkoper2, verkoper, verkoper, Verkoper, Twee, verkoper2@verkoper.nl, 0, 0";


--TEST--
Test check_if_email_password_exists()
--FILE--
<?php
        $user = self::find_by_email_password($array);
			if($user != null)
			{
				return true;	
			}
			
			else
			{
				return false;	
			}
?>
--EXPECT--
true;


--TEST--
Test get_rights()
--FILE--
<?php
        $user = self::find_by_email_password($array);
			return $user->rights;
?>
--EXPECT--
"verkoper";


--TEST--
Test find_by_email()
--FILE--
<?php
        $query = "SELECT * FROM `verkoper` WHERE `username` = '".$array['em']."'";	
		$login_data = self::find_by_sql($query);
		return array_shift($login_data);
?>
--EXPECT--
"2, verkoper2, verkoper, verkoper, Verkoper, Twee, verkoper2@verkoper.nl, 0, 0";


--TEST--
Test get_rights_by_email()
--FILE--
<?php
        global $database;
		
		$query = "SELECT rights FROM `verkoper` WHERE `username` = '".$username."'";
		
		$login_data = self::find_rights_by_sql($query);
		return array_shift($login_data);
?>
--EXPECT--
"verkoper";


--TEST--
Test byUsername()
--FILE--
<?php
        global $database;
		
		$query = "SELECT rights FROM `verkoper` WHERE `username` = '".$username."'";
		
		$login_data = self::find_rights_by_sql($query);
		return array_shift($login_data);
?>
--EXPECT--
"3, verkoper3, verkoper, verkoper, Verkoper, Drie, verkoper3@verkoper.nl, 1, 3";


--TEST--
Test updateInlogFout()
--FILE--
<?php
        global $database;
			$query = "UPDATE verkoper SET inlogFout = '".($aantal + 1)."' WHERE `username` = '".$username."' ";
			$database->fire_query($query);	
?>
--EXPECT--
inlogFout = 2 --> inlogFout = 3;


--TEST--
Test blokkeren()
--FILE--
<?php
        global $database;
			$query = "UPDATE verkoper SET geblokkeerd = '1' WHERE `username` = '".$username."' ";
			$database->fire_query($query);
?>
--EXPECT--
geblokkeerd = 0 --> geblokkeerd = 1;


--TEST--
Test deblokkeren()
--FILE--
<?php
        global $database;
			$query = "UPDATE verkoper SET geblokkeerd = '0', inlogFout = '0' WHERE `username` = '".$username."' ";
			$database->fire_query($query);	
?>
--EXPECT--
geblokkeerd = 1 --> geblokkeerd = 0;


--TEST--
Test find_all()
--FILE--
<?php
        $query = "SELECT id, username, voornaam, achternaam, email, datumTijd
					  FROM `verkoperlog`";	
			return self::find_by_sql($query);
?>
--EXPECT--
"1, verkoper, Verkoper, Een, verkoper@verkoper.nl, 2014-11-27 09:24:43"
"2, verkoper, Verkoper, Een, verkoper2@verkoper.nl, 2014-11-27 09:26:37"
"3, verkoper, Verkoper, Een, verkoper3@verkoper.nl, 2014-11-27 09:28:13"
"4, verkoper, Verkoper, Een, verkoper4@verkoper.nl, 2014-11-27 09:33:12"