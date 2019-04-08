<?php
	class Question
	{
		//private static curId=0;
		private $title;
		private $body;
		private $author;
		private $answers;
		private $id;
		
		/*public function __construct($title , $body , User $author)
		{
			$this->setTitle($title);
			$this->setBody($body);
			$this->setAuthor($author);
			//$this->id = ++self->$curId;
		}*/
		
		public function __construct($title , $body , User $author, $id)
		{
			$this->setTitle($title);
			$this->setBody($body);
			$this->setAuthor($author);
			$this->setId($id);
		}
		
		public function getId()
		{
			return $this->id;
		}
		
		public function setId($id)
		{
			$this->id = $id;
		}
		
		public function getTitle()
		{
			return $this->title;
		}
		
		public function setTitle($title)
		{
			$this->title = $title;
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
		
		public function getAnswers()
		{
			return $this->answers;
		}
		
		public function addAnswer(Answer $answer)
		{
			$this->answers[] = $answer;
		}

	}
?>