<?php
	require_once("MySQLDatabase.class.php");
	class Provincie_class
	{
		//Fields
		private $provincieId;
		private $provincieNaam;
			
		//Properties
		public function getProvincieId() { return $this->provincieId; }
		public function getProvincieNaam() { return $this->provincieNaam; }
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Provincie_class;
				$object->provincieId = $row->provincieId;
				$object->provincieNaam = $row->provincieNaam;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		
		public static function find_all()
		{
			$query = "SELECT provincieId, provincieNaam
					  FROM `provincie`";	
			return self::find_by_sql($query);
		}
	}
?>