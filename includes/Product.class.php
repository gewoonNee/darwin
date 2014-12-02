<?php
	require_once("MySQLDatabase.class.php");
	class Product_class
	{
		//Fields
		private $id;
		private $categorie;
		private $productnaam;
		private $prijs;
		private $fotonaam;
		private $beschrijving;
			
		//Properties
		public function getId() { return $this->id; }
		public function getCategorie() { return $this->categorie; }
		public function getProductnaam() { return $this->productnaam; }
		public function getPrijs() { return $this->prijs; }
		public function getFotonaam() { return $this->fotonaam; }
		public function getBeschrijving() { return $this->beschrijving; }
		public function getFilmpje() { return $this->filmpje;}
		public function getStartbod() { return $this->startbod;}
		public function getLaagstebod() { return $this->laagstebod;}
		public function getAankoop() { return $this->aankoop;}
		
		public static function find_by_sql($query)
		{
			global $database;
			$result = $database->fire_query($query);
			$object_array = array();
			
			while ($row = mysqli_fetch_object($result))
			{
				$object = new Product_class;
				$object->id = $row->id;
				$object->categorie = $row->categorie;
				$object->productnaam = $row->productnaam;
				$object->prijs = $row->prijs;
				$object->fotonaam = $row->fotonaam;
				$object->beschrijving = $row->beschrijving;
				$object->filmpje = $row->filmpje;
				$object->startbod = $row->startbod;
				$object->laagstebod = $row->laagstebod;
				$object->aankoop = $row->aankoop;
				
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function find_all()
		{
			$query = "SELECT * FROM `product`";	
			return self::find_by_sql($query);
		}
		
		public static function find_all_limit_offset( $limit, $offset)
		{
			$query = "SELECT * FROM `product` ORDER BY `categorie` LIMIT ".$limit." OFFSET ".$offset;	
			return self::find_by_sql($query);
		}
		
		public static function find_auto($id)
		{
			$query = "SELECT * FROM `product` WHERE `id` = '".$id."'";
			return self::find_by_sql($query);
		}
		
		public static function count_all_records()
		{
			global $database;
			$query = "SELECT * FROM `product`";
			$result = $database->fire_query($query);
			return mysqli_num_rows($result);	
		}
		
		public static function find_by_id($id)
		{
			$query = "SELECT * FROM `product` WHERE `id` = '".$id."'";
			return array_shift (self::find_by_sql($query));
		}
		
		public static function edit()
		{
			global $database;
			$query = "UPDATE `product` SET `productnaam` = '".$_POST['productnaam']."',
										   `fotonaam` = '".$_POST['fotonaam']."',
										   `beschrijving` = '".$_POST['beschrijving']."',
										   `categorie` = '".$_POST['categorie']."',
										   `prijs` = '".$_POST['prijs']."'
				      WHERE `id` = '".$_POST['id']."'";
		    $result = $database->fire_query($query);
		}
		
		public static function add()
		{		
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $_FILES["fotonaam"]["name"]);
			$extension = end($temp);
			if ((($_FILES["fotonaam"]["type"] == "image/gif")
			|| ($_FILES["fotonaam"]["type"] == "image/jpeg")
			|| ($_FILES["fotonaam"]["type"] == "image/jpg")
			|| ($_FILES["fotonaam"]["type"] == "image/pjpeg")
			|| ($_FILES["fotonaam"]["type"] == "image/x-png")
			|| ($_FILES["fotonaam"]["type"] == "image/png"))
			&& ($_FILES["fotonaam"]["size"] < 40000)
			&& in_array($extension, $allowedExts))
			  {
			  if ($_FILES["fotonaam"]["error"] > 0)
				{
				echo "Return Code: " . $_FILES["fotonaam"]["error"] . "<br>";
				}
			  else
				{
					echo "Auto toegevoegd.";
				if (file_exists("pictures/" . $_FILES["fotonaam"]["name"]))
				  {
				  echo $_FILES["fotonaam"]["name"] . " bestaat al. ";
				  }
				else
				  {
				  move_uploaded_file($_FILES["fotonaam"]["tmp_name"],
				  "pictures/" . $_FILES["fotonaam"]["name"]);
				  
				  global $database;
					$query = "INSERT INTO `product` (`productnaam`, `fotonaam`, `beschrijving`, `categorie`, `prijs`, `aankoop`) 
													VALUES('".$_POST['productnaam']."',
														   '".$_FILES['fotonaam']['name']."',
														   '".$_POST['beschrijving']."',
														   '".$_POST['categorie']."',
														   '".$_POST['prijs']."',
														   '".$_POST['datum']."')";
					$result = $database->fire_query($query);
				  
				  }
				}
			  }
			else
			  {
			  echo "Ongeldig bestand.";
			  }
		}
		
		public static function addAfspraak()
		{
			global $database;
			$query = "INSERT INTO `afspraak` (`datum`, `tijd`, `werknemer`, `klant`) 
											VALUES('".$_POST['datum']."',
												   '".$_POST['tijd']."',
											       '".$_POST['werknemer']."',
												   '".$_SESSION['user_id']."')";
			$result = $database->fire_query($query);
		}
		
		public static function find_all_afspraak()
		{
			$query = "SELECT * FROM `afspraak`";	
			return self::find_by_sql($query);
		}
		
	}
?>