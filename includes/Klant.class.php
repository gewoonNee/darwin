<?php
	require_once("MySQLDatabase.class.php");
	class Klant_class
	{
		//Fields
		private $klantId;
		private $klantVoornaam;
		private $klantAchternaam;
		private $klantPostcode;
		private $klantWoonplaats;
		private $klantProvincie;
		private $klantGeboortedatum;
		
		private $maxId;
		private $countAll;
		private $countProvincie;
			
		//Properties
		public function getKlantId() { return $this->klantId; }
		public function getKlantVoornaam() { return $this->klantVoornaam; }
		public function getKlantAchternaam() { return $this->klantAchternaam; }
		public function getKlantPostcode() { return $this->klantPostcode; }
		public function getKlantWoonplaats() { return $this->klantWoonplaats; }
		public function getKlantProvincie() { return $this->klantProvincie; }
		public function getKlantGeboortedatum() { return $this->klantGeboortedatum; }
		
		public function getMaxId() { return $this->maxId; }
		public function getCountAll() { return $this->countAll; }
		public function getCountProvincie() { return $this->countProvincie; }
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Klant_class;
				$object->klantId = $row->klantId;
				$object->klantVoornaam = $row->klantVoornaam;
				$object->klantAchternaam = $row->klantAchternaam;
				$object->klantPostcode = $row->klantPostcode;
				$object->klantWoonplaats = $row->klantWoonplaats;
				$object->klantProvincie = $row->klantProvincie;
				$object->klantGeboortedatum = $row->klantGeboortedatum;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function find_by_sql2($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Klant_class;
				$object->maxId = $row->maxId;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function find_by_sql3($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Klant_class;
				$object->countAll = $row->countAll;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function find_by_sql4($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Klant_class;
				$object->countProvincie = $row->countProvincie;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function find_all()
		{
			$query = "SELECT klantId, klantVoornaam, klantAchternaam, klantPostcode, klantWoonplaats, klantProvincie, klantGeboortedatum
					  FROM `klant`";	
			return self::find_by_sql($query);
		}
		
		/*public static function find_all_limit_offset( $limit, $offset)
		{
			$query = "SELECT * FROM `afspraak` ORDER BY `datum` LIMIT ".$limit." OFFSET ".$offset;	
			return self::find_by_sql($query);
		}
		
		public static function find_all_limit_offset_future( $limit, $offset, $id)
		{
			$query = "SELECT * FROM `afspraak` WHERE `datum` > CURDATE() AND `werknemer` = '".$id."' ORDER BY `datum` LIMIT ".$limit." OFFSET ".$offset;	
			return self::find_by_sql($query);
		}
		
		public static function find_all_limit_offset_klant( $limit, $offset, $id)
		{
			$query = "SELECT * FROM `afspraak` WHERE `datum` > CURDATE() AND `werknemer` = '".$id."' ORDER BY `klant` LIMIT ".$limit." OFFSET ".$offset;	
			return self::find_by_sql($query);
		}
		
		public static function count_all_records()
		{
			global $database;
			$query = "SELECT * FROM `afspraak`";
			$result = $database->fire_query($query);
			return mysqli_num_rows($result);	
		}
		
		public static function count_all_records_future($id)
		{
			global $database;
			$query = "SELECT * FROM `afspraak` WHERE `datum` > CURDATE() AND `werknemer` = '".$id."'";
			$result = $database->fire_query($query);
			return mysqli_num_rows($result);	
		}
		
		
		public static function find_by_id($id)
		{
			$query = "SELECT * FROM `afspraak` WHERE `id` = '".$id."'";
			return array_shift (self::find_by_sql($query));
		}*/
		
		
		
		
		public static function add()
		{
			global $database;
			$query = "INSERT INTO `klant` (`klantVoornaam`, `klantAchternaam`, `klantGeboortedatum`, `klantPostcode`, `klantWoonplaats`, `klantProvincie`) 
											VALUES('".$_POST['voornaam']."',
												   '".$_POST['achternaam']."',
											       '".$_POST['geboortedatum']."',
												   '".$_POST['postcode']."',
												   '".$_POST['woonplaats']."',
												   '".$_POST['provincie']."')";
			$result = $database->fire_query($query);
		}
		
		public static function laatsteKlant()
		{
			global $database;
			$query = "SELECT MAX(klantId) as maxId FROM klant";
			
			//$result = $database->fire_query($query);
			//return array_shift (self::find_by_sql($query));
			
			$klantId = self::find_by_sql2($query);
			return array_shift($klantId);
		}
		
		public static function countKlanten($vandaag, $week)
		{
			global $database;
			$query = "SELECT COUNT(klant.klantId) as countAll FROM klant
					   INNER JOIN reservering ON klant.klantId = reservering.klantId
					   WHERE reservering.datumBezoek <= '".$vandaag."' AND reservering.datumBezoek >= '".$week."'";
			
			$klantId = self::find_by_sql3($query);
			return array_shift($klantId);
		}
		
		public static function countKlantenProvincie($vandaag, $week)
		{
			global $database;
			$query = "SELECT COUNT(klant.klantId) as countProvincie FROM klant
					  INNER JOIN reservering ON klant.klantId = reservering.klantId
				      WHERE klant.klantProvincie = 'Utrecht' AND reservering.datumBezoek <= '".$vandaag."' AND reservering.datumBezoek >= '".$week."'";
			
			$klantId = self::find_by_sql4($query);
			return array_shift($klantId);
		}
		
		public static function countKlantenJaar($vandaag, $jaar)
		{
			global $database;
			$query = "SELECT COUNT(klant.klantId) as countAll FROM klant
					   INNER JOIN reservering ON klant.klantId = reservering.klantId
					   WHERE reservering.datumBezoek <= '".$vandaag."' AND reservering.datumBezoek >= '".$jaar."'";
			
			$klantId = self::find_by_sql3($query);
			return array_shift($klantId);
		}
		
		public static function countKlantenProvincieJaar($vandaag, $jaar)
		{
			global $database;
			$query = "SELECT COUNT(klant.klantId) as countProvincie FROM klant
					  INNER JOIN reservering ON klant.klantId = reservering.klantId
				      WHERE klant.klantProvincie = 'Utrecht' AND reservering.datumBezoek <= '".$vandaag."' AND reservering.datumBezoek >= '".$jaar."'";
			
			$klantId = self::find_by_sql4($query);
			return array_shift($klantId);
		}
		
	}
?>