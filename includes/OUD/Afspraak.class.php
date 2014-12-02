<?php
	require_once("MySQLDatabase.class.php");
	class Afspraak_class
	{
		//Fields
		private $id;
		private $datum;
		private $tijd;
		private $werknemer;
		private $klant;
		private $onderwerp;
			
		//Properties
		public function getId() { return $this->id; }
		public function getDatum() { return $this->datum; }
		public function getTijd() { return $this->tijd; }
		public function getWerknemer() { return $this->werknemer; }
		public function getKlant() { return $this->klant; }
		public function getOnderwerp() { return $this->onderwerp; }
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Afspraak_class;
				$object->id = $row->id;
				$object->datum = $row->datum;
				$object->tijd = $row->tijd;
				$object->werknemer = $row->werknemer;
				$object->klant = $row->klant;
				$object->onderwerp = $row->onderwerp;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function find_all()
		{
			$query = "SELECT * FROM `afspraak`";	
			return self::find_by_sql($query);
		}
		
		public static function find_all_limit_offset( $limit, $offset)
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
		}
		
		
		
	}
?>