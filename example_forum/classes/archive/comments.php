<?php
	class Comment
	{
		//private static curId=0;
		private $answer;
		private $body;
		private $author;
		private $id;
		
		public function __construct(Answer $answer , $body , User $author , $id)
		{
			$this->setAnswer($answer);
			$this->setBody($body);
			$this->setAuthor($author);
			$this->setId($id);
		}
		
		public function getId()
		{
			return $this->id;
		}
		public function setID($id)
		{
			$this-> id = $id;
		}
		
		
		public function getAnswer()
		{
			return $this->question;
		}
		
		public function setAnswer(Answer $answer)
		{
			$this->answer = $answer;
		}
		
		public function getBody()
		{
			return $this->body;
		}
		
		public function setBody($body)
		{
			$this->body = $body;
		}
		
		public function getAuthor()
		{
			return $this->author;
		}
		
		public function setAuthor(User $author)
		{
			$this->author = $author;
		}

	}
?>