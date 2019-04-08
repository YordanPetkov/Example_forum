<?php
	class Answer
	{
		//private static curId=0;
		private $question;
		private $body;
		private $author;
		private $comments;
		private $id;
		
		public function __construct(Question $question , $body , User $author, $id)
		{
			$this->setQuestion($question);
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
			$this->$id = $id;
		}
		
		public function getQuestion()
		{
			return $this->question;
		}
		
		public function setQuestion(Question $question)
		{
			$this->question = $question;
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
		
		public function getComments()
		{
			return $this->comments;
		}
		
		public function addComments(Comment $comment)
		{
			$this->comments[] = $comment;
		}

	}
?>