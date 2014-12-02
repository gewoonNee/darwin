<?php
	require_once("MySQLDatabase.class.php");
	class Vraag_class
	{
		//Fields
		private $id;
		private $vraag;
		private $antwoord;
			
		//Properties
		public function getId() { return $this->id; }
		public function getVraag() { return $this->vraag; }
		public function getAntwoord() { return $this->antwoord; }
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Vraag_class;
				$object->id = $row->id;
				$object->vraag = $row->vraag;
				$object->antwoord = $row->antwoord;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function find_all()
		{
			$query = "SELECT * FROM `vraag` WHERE `antwoord` IS NOT NULL AND TRIM(`antwoord`) <> ''";	
			return self::find_by_sql($query);
		}
		
		public static function find_all_geenantwoord()
		{
			$query = "SELECT * FROM `vraag` WHERE `antwoord` = ''";	
			return self::find_by_sql($query);
		}
		
		public static function find_all_limit_offset( $limit, $offset)
		{
			$query = "SELECT * FROM `vraag` LIMIT ".$limit." OFFSET ".$offset;	
			return self::find_by_sql($query);
		}
		
		public static function count_all_records()
		{
			global $database;
			$query = "SELECT * FROM `vraag`";
			$result = $database->fire_query($query);
			return mysqli_num_rows($result);	
		}
		
		public static function find_by_id($id)
		{
			$query = "SELECT * FROM `vraag` WHERE `id` = '".$id."'";
			return array_shift (self::find_by_sql($query));
		}
		
		
		
		
		public static function add()
		{
			global $database;
			$query = "INSERT INTO `vraag` (`vraag`) 
											VALUES('".$_POST['vraag']."')";
			$result = $database->fire_query($query);
		}
		
		public static function antwoord()
		{
			global $database;
			$query = "UPDATE `vraag` SET `antwoord` = '".$_POST['antwoord']."'
									 WHERE `id` = '".$_POST['id']."'";
									 //echo $query;
			$database->fire_query($query);
		}
		
		
	}
?>