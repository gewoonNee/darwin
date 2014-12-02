<?php
	require_once("config.php");
	class MySQLDatabase_class
	{
		//Fields
		private $db_connection;
		private $databaseName = "webshop";
		
		//Properties
		public function getDatabaseName() {	return $this->databaseName; }
		public function setDatabaseName($value) { $this->databaseName = $value; }
		
		//Constructor
		public function __construct()
		{
			$this->db_connection = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD) or die ("Could not contact the database");
			mysqli_select_db ($this->db_connection, DATABASE_NAME) or die ("Could not find the database");
		}
		
		//Methods
		public function fire_query($query)
		{
			$result = mysqli_query($this->db_connection, $query) or die($query);
			return $result;
		}
	}
	
	$database = new MySQLDatabase_class();
?>