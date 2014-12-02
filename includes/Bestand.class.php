<?php
	require_once("MySQLDatabase.class.php");
	class Bestand_class
	{
		//Fields
		private $id;
		private $naam;
		private $fotonaam;
		private $filmpje;
		private $datumToevoeging;
			
		//Properties
		public function getId() { return $this->id; }
		public function getNaam() { return $this->naam; }
		public function getFotoNaam() { return $this->fotonaam; }
		public function getFilmpje() { return $this->filmpje; }
		public function getDatumToevoeging() { return $this->datumToevoeging; }
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Bestand_class;
				$object->id = $row->id;
				$object->naam = $row->naam;
				$object->fotonaam = $row->fotonaam;
				$object->filmpje = $row->filmpje;
				$object->datumToevoeging = $row->datumToevoeging;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		/*public static function find_by_sql2($query)
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
		}*/
		
		public static function find_all()
		{
			$query = "SELECT id, naam, fotonaam, filmpje, datumToevoeging
					  FROM `bestand`";	
			return self::find_by_sql($query);
		}
			
		
		public static function add($datum)
		{
			global $database;
			$query = "INSERT INTO `bestand` (`naam`, `fotonaam`, `filmpje`, `datumToevoeging`) 
											VALUES('".$_POST['naam']."',
												   '".$_POST['naam'].".jpg',
											       '".$_POST['filmpje']."',
												   '".$datum."')";
			$result = $database->fire_query($query);
		}
		
		public static function delete($id)
		{
			global $database;
			$query = "DELETE FROM `bestand` WHERE `id` = '".$id."'";
			$result = $database->fire_query($query);
		}
		
	}
?>