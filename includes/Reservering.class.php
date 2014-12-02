<?php
	require_once("MySQLDatabase.class.php");
	class Reservering_class
	{
		//Fields
		private $reserveringId;
		private $klantId;
		private $datumBezoek;
		private $code;
		private $barcode;
		private $prijs;
		private $aantal;
		private $datumReservering;
		
		private $maxCode;
		private $maxBarcode;
			
		//Properties
		public function getReserveringId() { return $this->reserveringId; }
		public function getKlantId() { return $this->klantId; }
		public function getDatumBezoek() { return $this->datumBezoek; }
		public function getCode() { return $this->code; }
		public function getBarcode() { return $this->barcode; }
		public function getPrijs() { return $this->prijs; }
		public function getAantal() { return $this->aantal; }
		public function getDatumReservering() { return $this->datumReservering; }
		
		public function getMaxCode() { return $this->maxCode; }
		public function getMaxBarcode() { return $this->maxBarcode; }
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Reservering_class;
				$object->reserveringId = $row->reserveringId;
				$object->klantId = $row->klantId;
				$object->datumBezoek = $row->datumBezoek;
				$object->code = $row->code;
				$object->barcode = $row->barcode;
				$object->prijs = $row->prijs;
				$object->datumReservering = $row->datumReservering;
				
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
				$object = new Reservering_class;
				$object->reserveringId = $row->reserveringId;
				$object->klantId = $row->klantId;
				$object->datumBezoek = $row->datumBezoek;
				$object->code = $row->code;
				$object->barcode = $row->barcode;
				$object->prijs = $row->prijs;
				$object->aantal = $row->aantal;
				$object->datumReservering = $row->datumReservering;
				
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
				$object = new Reservering_class;
				$object->maxCode = $row->maxCode;
				$object->maxBarcode = $row->maxBarcode;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function find_all()
		{
			$query = "SELECT reserveringId, klantId, datumBezoek, code, barcode, prijs, datumReservering
					  FROM `reservering`";	
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
		
		
		
		
		public static function add($klantId, $vandaag, $code, $barcode, $prijs)
		{
			global $database;
			$query = "INSERT INTO `reservering` (`klantId`, `datumBezoek`, `code`, `barcode`, `prijs`, datumReservering) 
											VALUES('".$klantId."',
												   '".$_POST['datum']."',
												   '".$code."',
												   '".$barcode."',
												   '".$prijs."',
												   '".$vandaag."')";
			$result = $database->fire_query($query);
		}
		
		public static function perDag($vandaag)
		{
			$query = "SELECT reserveringId, klantId, datumBezoek, code, barcode, prijs, COUNT(datumBezoek) as aantal, datumReservering
					  FROM `reservering`
					  WHERE datumBezoek = '".$vandaag."'";	
			return self::find_by_sql2($query);
		}
		
		public static function perWeek($vandaag, $week)
		{
			$query = "SELECT reserveringId, klantId, datumBezoek, code, barcode, prijs, COUNT(datumBezoek) as aantal, datumReservering
					  FROM `reservering`
					  WHERE datumBezoek <= '".$vandaag."' AND datumBezoek >= '".$week."'";	
			return self::find_by_sql2($query);
		}
		
		public static function reserveringen($vandaag)
		{
			$query = "SELECT reserveringId, klantId, datumBezoek, code, barcode, prijs, COUNT(datumBezoek) as aantal, datumReservering
					  FROM `reservering`
					  WHERE datumReservering = '".$vandaag."'";	
			return self::find_by_sql2($query);
		}
		
		public static function laatsteCodes()
		{
			global $database;
			$query = "SELECT MAX(code) as maxCode, MAX(barcode) as maxBarcode FROM reservering";
			
			//$result = $database->fire_query($query);
			//return array_shift (self::find_by_sql($query));
			
			$codes = self::find_by_sql3($query);
			return array_shift($codes);
		}
		
		
	}
?>