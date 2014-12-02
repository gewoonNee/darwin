<?php
	require_once("MySQLDatabase.class.php");
	
	class VerkoperLog_class
	{
		//Fields
		private $id;
		private $username;
		private $voornaam;
		private $achternaam;
		private $email;
		private $datumTijd;
		
		
		//Properties
		public function getId() { return $this->id; }
		public function getUsername() { return $this->username; }
		public function getVoornaam() { return $this->voornaam; }
		public function getAchternaam() { return $this->achternaam; }
		public function getEmail() { return $this->email; }
		public function getDatumTijd() { return $this->datumTijd; }
		
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new VerkoperLog_class;
				$object->id = $row->id;
				$object->username = $row->username;
				$object->voornaam = $row->voornaam;
				$object->achternaam = $row->achternaam;
				$object->email = $row->email;
				$object->datumTijd = $row->datumTijd;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
				
		//Vraagt alle gegevens op uit de tabel verkoperlog
		public static function find_all()
		{
			$query = "SELECT id, username, voornaam, achternaam, email, datumTijd
					  FROM `verkoperlog`";	
			return self::find_by_sql($query);
		}
		
		//Voegt loggegevens toe
		public static function add($username, $voornaam, $achternaam, $email, $datumTijd, $inloggenMislukt)
		{
			global $database;
			$query = "INSERT INTO `verkoperlog` (`username`, `voornaam`, `achternaam`, `email`, `datumTijd`, inloggenMislukt) 
											VALUES('".$username."',
												   '".$voornaam."',
												   '".$achternaam."',
												   '".$email."',
												   '".$datumTijd."',
												   '".$inloggenMislukt."')";
			$result = $database->fire_query($query);
		}

	
	}
?>