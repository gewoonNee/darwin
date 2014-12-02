<?php
	require_once("MySQLDatabase.class.php");
	
	class Log_class
	{
		private $id;
		private $userId;
		private $datumTijd;
		
		public function getId() { return $this->id; }
		public function getUserId() { return $this->userId; }
		public function getDatumTijd() { return $this->datumTijd; }
		
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Log_class;
				$object->id = $row->id;
				$object->userId = $row->userId;
				$object->datumTijd = $row->datumTijd;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
				
		
		public static function find_all()
		{
			$query = "SELECT id, userId, datumTijd
					  FROM `verkoperlog`";	
			return self::find_by_sql($query);
		}
		
		public static function add($userId, $datumTijd)
		{
			global $database;
			$query = "INSERT INTO `log` (`userId`, `datumTijd`) 
											VALUES('".$userId."',
												   '".$datumTijd."')";
			$result = $database->fire_query($query);
		}

	
	}
?>