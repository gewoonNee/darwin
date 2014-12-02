<?php
	require_once("MySQLDatabase.class.php");
	
	class User_class
	{
		//Fields
		private $id;
		private $firstname;
		private $lastname;
		private $address;
		private $city;
		private $province;
		private $zip;
		private $country;
		private $tel_number;
		private $mob_number;
		private $email;
		private $fax;
		
		//Properties
		public function getId() { return $this->id; }
		public function getFirstname() { return $this->firstname; }
		public function getLastname() { return $this->lastname; }
		public function getAddress() { return $this->address; }
		public function getCity() { return $this->city; }
		public function getProvince() { return $this->province; }
		public function getZip() { return $this->zip; }
		public function getCountry() { return $this->country; }
		public function getTel_number() { return $this->tel_number; }
		public function getMob_number() { return $this->mob_number; }
		public function getEmail() { return $this->email; }
		public function getFax() { return $this->fax; }
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new User_class;
				$object->id = $row->id;
				$object->firstname = $row->firstname;
				$object->lastname = $row->lastname;
				$object->address = $row->address;
				$object->city = $row->city;
				$object->province = $row->province;
				$object->zip = $row->zip;
				$object->country = $row->country;
				$object->tel_number = $row->tel_number;
				$object->mob_number = $row->mob_number;
				$object->email = $row->email;
				$object->fax = $row->fax;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function insert_into_user($postarray)
		{
			global $database;
			//query = "INSERT INTO `user` ( `id`, `firstname`, `lastname`, `address`, `city`, `province`, `zip`, `country`, `tel_number`, `mob_number`, `email`, `fax`) VALUES ( NULL,  '".$postarray['firstname']."', '".$postarray['lastname']."', '".$postarray['address']."', '".$postarray['city']."', '".$postarray['province']."', '".$postarray['zip']."', '".$postarray['country']."', '".$postarray['telnum']."', '".$postarray['mobnum']."', '".$postarray['email']."', '".$postarray['fax']."')";	
			$query = "INSERT INTO `login` (`id`, `username`, `password`, `rights`) VALUES ( NULL, '".$postarray['username']."', '".$postarray['password']."', 'klant')";
			$database->fire_query($query);
			
		}
		
		public static function find_by_email($email)
		{
			//$query = "SELECT * FROM `user` WHERE `email` = '".$email."'";
			//$array = self::find_by_sql($query);
			//return array_shift($array);
			
		}
		
		public static function send_activation_email($user, $password)
		{
			$receiver = $user->getEmail();
			$headers = "FROM: koel@ditIsEenZeerExclusiefEmailadres.be\r\n
						Reply-To: koel@ditIsEenZeerExclusiefEmailadres.be\r\n
						X-mailer: PHP/".phpversion();
			$subject = "Waarschuwing";
			$message = "Doe niet.\n\n
						http://localhost/webshop/index.php?action=activatie&em=".$receiver."&pw=".$password."\n\n
						De groetenwinkel";	
						
			mail($receiver, $subject, $message, $headers);
		}
	}
?>