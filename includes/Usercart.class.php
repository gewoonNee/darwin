<?php
	require_once("MySQLDatabase.class.php");
	
	class Usercart_class
	{
		private $userId;
		private $cartContent;
		private $datum;
		
		public function getUserId()
		{
			return $this->userId;
		}
		
		public function getCartContent()
		{
			return $this->cartContent;	
		}
		
		public function getDatum()
		{
			return $this->datum;
		}
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Usercart_class;
				$object->userId = $row->userId;
				$object->cartContent = $row->cartContent;
				$object->datum = $row->datum;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function insertIntoUsercart($serializedCart, $datum)
		{
			global $database;
			$query = "INSERT INTO `usercart` (`userId`, `cartContent`, `datum`) VALUES ('".$_SESSION['user_id']."', '".$serializedCart."', '".$datum."')";
			$database->fire_query($query);
		}
		
		public static function find_by_id()
		{
			$query = "SELECT * FROM `userCart` WHERE `userId` = '".$_SESSION['user_id']."'";
			return array_shift(self::find_by_sql($query));
		}
		
		public static function updateUsercart($userId, $serialized, $datum)
		{
			global $database;
			$query = "UPDATE `userCart` SET `cartContent` = '".$serialized."', `datum` = '".$datum."' WHERE `userId` = '".$userId."'";
			$database->fire_query($query);
		}
	}
?>