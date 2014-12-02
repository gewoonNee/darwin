<?php
	class Pagination_class
	{
		//Fields
		private $current_page;
		private $records_per_page;
		private $total_amount_of_records;
		
		//Properties
		public function getRecords_per_page() { return $this->records_per_page; }
		
		//Constructor
		public function __construct($current_page = 1, $records_per_page = 3, $total_amount_of_records = 0)
		{
			$this->current_page = $current_page;
			$this->records_per_page = $records_per_page;
			$this->total_amount_of_records = $total_amount_of_records;
		}
		
		//Methods
		public function offset()
		{
			return ($this->current_page - 1) * $this->records_per_page;
		}
		
		public function totalPages()
		{
			return ceil($this->total_amount_of_records / $this->records_per_page);	
		}
		
		public function getCurrentPage()
		{
			return $this->current_page;	
		}
		
		public function previousPage()
		{
			return $this->current_page - 1;	
		}
		
		public function nextPage()
		{
			return $this->current_page + 1;	
		}
		
		public function hasPreviousPage()
		{
			return $this->current_page > 1;	
		}
		
		public function hasNextPage()
		{
			return $this->current_page < $this->totalPages();	
		}
	}

?>