<?php
	require_once("MySQLDatabase.class.php");
	
	class VerkoperLogin_class
	{
		//Fields
		private $id;
		private $username;
		private $password;
		private $rights;
		private $voornaam;
		private $achternaam;
		private $email;
		private $geblokkeerd;
		private $inlogFout;
		
		//Properties
		public function getId() { return $this->id; }
		public function getUsername() { return $this->username; }
		public function getPassword() { return $this->password; }
		public function getRights() { return $this->rights; }
		public function getVoornaam() { return $this->voornaam; }
		public function getAchternaam() { return $this->achternaam; }
		public function getEmail() { return $this->email; }
		public function getGeblokkeerd() { return $this->geblokkeerd; }
		public function getInlogFout() { return $this->inlogFout; }
		
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new VerkoperLogin_class;
				$object->id = $row->id;
				$object->username = $row->username;
				$object->password = $row->password;
				$object->rights = $row->rights;
				
				$object->voornaam = $row->voornaam;
				$object->achternaam = $row->achternaam;
				$object->email = $row->email;
				$object->geblokkeerd = $row->geblokkeerd;
				$object->inlogFout = $row->inlogFout;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		//Vraagt alle gegevens op uit de tabel verkoper
		public static function find_all()
		{
			$query = "SELECT id, username, password, rights, voornaam, achternaam, email, geblokkeerd, inlogFout
					  FROM `verkoper`";	
			return self::find_by_sql($query);
		}
		
		//Vraagt alle gegevens op uit de tabel verkoper betreffende accounts die geblokkeerd zijn
		public static function find_geblokkeerd()
		{
			$query = "SELECT id, username, password, rights, voornaam, achternaam, email, geblokkeerd, inlogFout
					  FROM `verkoper` WHERE geblokkeerd = '1'";	
			return self::find_by_sql($query);
		}
		
		//Bekijkt of de gebruikersnaam bestaat
		public static function emailadress_exists($email)
		{
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
		}
		
		//Zoekt gegevens op door middel van gebruikersnaam en wachtwoord
		public static function find_by_email_password($array)
		{
			$query = "SELECT * FROM `verkoper` WHERE `username` = '".$array['em']."' && `password` = '".$array['pw']."' ";	
			$login_data = self::find_by_sql($query);
			return array_shift($login_data);
		}
		
		
		//Bekijkt of de combinatie gebruikersnaam en wachtwoord bestaat
		public static function check_if_email_password_exists($array)
		{
			$user = self::find_by_email_password($array);
			if($user != null)
			{
				return true;	
			}
			
			else
			{
				return false;	
			}
		}
		
		
		//Vraagt de rechten op van de gebruiker
		public static function get_rights($array)
		{
			$user = self::find_by_email_password($array);
			return $user->rights;
				
		}
		
		
		//Vraagt gegevens op door middel van gebruikersnaam
		public static function find_by_email($array)
		{
			$query = "SELECT * FROM `verkoper` WHERE `username` = '".$array['em']."'";	
			$login_data = self::find_by_sql($query);
			return array_shift($login_data);
		}
		
		public static function find_rights_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Login_class;
				$object->rights = $row->rights;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		
		//Vraagt rechten op door middel van gebruikersnaam
		public static function get_rights_by_email($username)
		{
			global $database;
			//$user = self::find_by_email($array);
			$query = "SELECT rights FROM `verkoper` WHERE `username` = '".$username."'";
			
			$login_data = self::find_rights_by_sql($query);
			return array_shift($login_data);
				
		}
		
		
		//Vraagt gegevens op door middel van gebruikersnaam
		public static function byUsername($username)
		{
			$query = "SELECT * FROM verkoper WHERE username = '".$username."'";
			
			$data = self::find_by_sql($query);
			return array_shift($data);
		}
		
		
		//Verandert het aantal keer verkeerd ingelogd
		public static function updateInlogFout($aantal, $username)
		{
			global $database;
			$query = "UPDATE verkoper SET inlogFout = '".($aantal + 1)."' WHERE `username` = '".$username."' ";
			$database->fire_query($query);	
		}
		
		
		//Zet de status van een gebruiker op geblokkeerd
		public static function blokkeren($username)
		{
			global $database;
			$query = "UPDATE verkoper SET geblokkeerd = '1' WHERE `username` = '".$username."' ";
			$database->fire_query($query);	
		}
		
		
		//Zet de status van een gebruiker op gedeblokkeerd
		public static function deblokkeren($username)
		{
			global $database;
			$query = "UPDATE verkoper SET geblokkeerd = '0', inlogFout = '0' WHERE `username` = '".$username."' ";
			$database->fire_query($query);	
		}
		
		
		
		/*public static function geblokkeerdeAccounts()
		{
			$query = "SELECT id, username, password, rights, voornaam, achternaam, email, geblokkeerd, inlogFout FROM `verkoper` WHERE geblokkeerd = '1'";
			
			$data = self::find_by_sql($query);
			//return array_shift($data);
		}*/
		
	}
?>