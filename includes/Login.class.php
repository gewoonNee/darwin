<?php
	require_once("MySQLDatabase.class.php");
	
	class Login_class
	{
		private $id;
		private $username;
		private $password;
		private $rights;
		
		public function getId() { return $this->id; }
		public function getUsername() { return $this->username; }
		public function getPassword() { return $this->password; }
		public function getRights() { return $this->rights; }
		
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Login_class;
				$object->id = $row->id;
				$object->username = $row->username;
				$object->password = $row->password;
				$object->rights = $row->rights;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function emailadress_exists($email)
		{
			global $database;
			$query = "SELECT * FROM `login` WHERE `username` = '".$email."'";
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
		
		public static function find_by_email_password($array)
		{
			$query = "SELECT * FROM `login` WHERE `username` = '".$array['em']."' && `password` = '".$array['pw']."' ";	
			$login_data = self::find_by_sql($query);
			return array_shift($login_data);
		}
		
		
		public static function update_password($array)
		{
			global $database;
			$query = "UPDATE `login` SET `password` = '".$array['password']."' WHERE `username` = '".$array['em']."' ";
			$database->fire_query($query);	
		}
		
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
		
		
		
		public static function get_rights($array)
		{
			$user = self::find_by_email_password($array);
			return $user->rights;
				
		}
		
		
		public static function find_by_email($array)
		{
			$query = "SELECT * FROM `login` WHERE `username` = '".$array['em']."'";	
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
		
		public static function get_rights_by_email($username)
		{
			global $database;
			//$user = self::find_by_email($array);
			$query = "SELECT rights FROM `login` WHERE `username` = '".$username."'";
			
			$login_data = self::find_rights_by_sql($query);
			return array_shift($login_data);
				
		}
		
		public static function klantnaam($id)
		{
			$query = "SELECT * FROM `login` WHERE `id` = '".$id."'";
			return array_shift (self::find_by_sql($query));
		}
		
		public static function werknemer()
		{
			$query = "SELECT * FROM `login` WHERE `rights` = 'admin'";
			return self::find_by_sql($query);
		}

	
	}
?>