<?php
	
	class User
	{
		private $username;
		private $questions;
		private $answers;
		private $comments;
		
		public function __construct($username)
		{
			$this -> setUsername($username);
		}
		
		public function getUsername()
		{
			return $this->username;
			
		}
		
		public function setUsername($username)
		{
			$this -> username = $username;
		}
	}


?>