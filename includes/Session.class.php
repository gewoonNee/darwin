<?php
	class Session_class
	{
		//Fields
		private $logged_in = false;
		private $user_id;
		private $user_rights;
		private $email;
		private $user_name;
		
		
		//Properties
		public function getLoggedIn() { return $this->logged_in; }
		
		//Constructor
		public function __construct()
		{
			session_start();
			$this->	checklogin();
		}
		
		//Methods
		public function login($user)
		{
			$this->user_id = $_SESSION['user_id'] = $user->getId();
			$this->user_rights = $_SESSION['user_rights'] = $user->getRights();
			$this->user_name = $_SESSION['user_name'] = $user->getUsername();
			$this->logged_in = true;
		}
		
		private function checklogin()
		{
			if(isset($_SESSION['user_id']))
			{
				$this->user_id = $_SESSION['user_id'];
				$this->user_role = $_SESSION['user_rights'];
				$this->logged_in = true;
			}
			
			else
			{
				unset($this->user_id);
				unset($this->user_rights);
				$this->logged_in = false;
			}
		}
		
		public function logout()
		{
			if(isset($_SESSION['cart']))
			{
				//$_SESSION['cart']->serializeSaveCart();	
			}
			$this->logged_in = false;
			session_destroy();
		}
		
		}
			
	
	$session = new Session_class();
?>