<?php
	require_once("MySQLDatabase.class.php");
	class Openingstijden_class
	{
		//Fields
		private $dagNummer;
		private $dagNaam;
		private $tijdOpeningUur;
		private $tijdOpeningMinuut;
		private $tijdSluiting;
			
		//Properties
		public function getDagNummer() { return $this->dagNummer; }
		public function getDagNaam() { return $this->dagNaam; }
		public function getTijdOpeningUur() { return $this->tijdOpeningUur; }
		public function getTijdOpeningMinuut() { return $this->tijdOpeningMinuut; }
		public function getTijdSluitingUur() { return $this->tijdSluitingUur; }
		public function getTijdSluitingMinuut() { return $this->tijdSluitingMinuut; }
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Openingstijden_class;
				$object->dagNummer = $row->dagNummer;
				$object->dagNaam = $row->dagNaam;
				$object->tijdOpeningUur = $row->tijdOpeningUur;
				$object->tijdOpeningMinuut = $row->tijdOpeningMinuut;
				$object->tijdSluitingUur = $row->tijdSluitingUur;
				$object->tijdSluitingMinuut = $row->tijdSluitingMinuut;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function find_all()
		{
			$query = "SELECT dagNummer, dagNaam, 
					  HOUR(tijdOpening) as tijdOpeningUur, MINUTE(tijdOpening) as tijdOpeningMinuut, 
					  HOUR(tijdSluiting) as tijdSluitingUur, MINUTE(tijdSluiting) as tijdSluitingMinuut
					  FROM `openingstijden`";	
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
		}
		
		
		
		
		public static function add()
		{
			global $database;
			$query = "INSERT INTO `afspraak` (`datum`, `tijd`, `werknemer`, `klant`, `onderwerp`) 
											VALUES('".$_POST['datum']."',
												   '".$_POST['tijd']."',
											       '".$_POST['werknemer']."',
												   '".$_SESSION['user_id']."',
												   '".$_POST['onderwerp']."')";
			$result = $database->fire_query($query);
		}*/
		
		
		
	}
?>