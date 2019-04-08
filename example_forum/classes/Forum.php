<?php
	
	class Forum
	{
		private $questions;
		private $answers;
		private $comments;
		private $CurrentUser;
		private $CountQuestions=0;
		private $CountAnswers=0;
		private $CountComments=0;
		
		public function __construct()
		{
			
		}
		public function setCurrentUser(User $user)
		{
			$this->CurrentUser = $user;
			$this->CurrentUser->setUsername($user->getUsername());
		}
		
		public function getCurrentUser()
		{
			return $this->CurrentUser;
		}
		
		public function setQuestion(Question $question)
		{
			$link =new mysqli("localhost" , "exlogin" , "123456" ,"forum" );
						
			if($link === false)
			{
				die("ERROR: Could not connect. " . mysql_connect_error());
			}
			
			$title = $question->getTitle();
			$body = $question->getBody();
			$author = $question->getAuthor()->getUsername();
			$id = $question->getId();
			$query =
			    "
				INSERT INTO questions
				VALUES ('$title','$body','$author','$id')
				";
			if(mysqli_query($link, $query)){

				//echo "Records inserted successfully.";

			} 
			
			else
			{
				echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
			}
			$link->close();
		}
		
		public function getQuestions()
		{
			$this->CountQuestions = 0;
			$link =new mysqli("localhost" , "exlogin" , "123456" , "forum");
						
						if($link === false)
						{
							die("ERROR: Could not connect. " . mysql_connect_error());
						}
						
						$query = "select * from questions";
						$result = $link -> query($query);
						//echo empty($result);
						
						 
						if(!empty($result))
						{
							while($row = mysqli_fetch_row($result))
							{
								$this->CountQuestions++;
								$title = $row[0];
								$author = $row[2];
								$this->questions[$this->CountQuestions]["title"] = $row[0];
								$this->questions[$this->CountQuestions]["body"] = $row[1];
								$this->questions[$this->CountQuestions]["author"] = $row[2];
								$this->questions[$this->CountQuestions]["id"] = $row[3];
							}
						}
						else
						{
							echo "You can't logged in!";
							die();
						}
						
						$link -> close();
						return $this->questions;
		}
		
		public function setAnswer(Answer $answer)
		{
			$link =new mysqli("localhost" , "exlogin" , "123456" ,"forum" );
						
			if($link === false)
			{
				die("ERROR: Could not connect. " . mysql_connect_error());
			}
			if(!session_id()) session_start();
			$NumberOfQuestion = $_SESSION['NumberOfQuestion'];
			$body = $answer->getBody();
			$question = $NumberOfQuestion[0];
			$author = $answer->getAuthor()->getUsername();
			$id = $this -> getCountAnswers() + 1;
			$query =
			    "
				INSERT INTO answers (body , question , author , id)
				VALUES ('$body','$question','$author' , $id)
				";
			if(mysqli_query($link, $query)){

				//echo "Records inserted successfully.";

			} 
			
			else
			{
				echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
			}
			$link->close();
		}
		
		
		public function getAnswer()
		{
			$this->CountAnswers = 0;
			$link =new mysqli("localhost" , "exlogin" , "123456" , "forum");
						
						if($link === false)
						{
							die("ERROR: Could not connect. " . mysql_connect_error());
						}
						
						$query = "select * from answers";
						$result = $link -> query($query);
						//echo empty($result);
						
						 
						if(!empty($result))
						{
							
							while($row = mysqli_fetch_row($result))
							{
								$this->CountAnswers++;
								$title = $row[0];
								$author = $row[2];
								$this->answers[$this->CountAnswers]["body"] = $row[0];
								$this->answers[$this->CountAnswers]["question"] = $row[1];
								$this->answers[$this->CountAnswers]["author"] = $row[2];
								$this->answers[$this->CountAnswers]["id"] = $row[3];
							}
						}
						else
						{
							echo "You can't logged in!";
							die();
						}
						
						$link -> close();
						return $this->answers;
		}
		
		public function setComment(Comment $comment)
		{
			$link =new mysqli("localhost" , "exlogin" , "123456" ,"forum" );
						
			if($link === false)
			{
				die("ERROR: Could not connect. " . mysql_connect_error());
			}
			if(!session_id()) session_start();
			$NumberOfQuestion = $_SESSION['NumberOfQuestion'];
			$body = $comment->getBody();
			$question = $NumberOfQuestion[0];
			$answer = $NumberOfQuestion[1];
			$author = $comment->getAuthor()->getUsername();
			$id = $this->getCountComments() + 1;
			$query =
			    "
				INSERT INTO comments (body , questions , answer , author, id)
				VALUES ('$body','$question' ,'$answer','$author',$id)
				";
			if(mysqli_query($link, $query)){

				//echo "Records inserted successfully.";

			} 
			
			else
			{
				echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
			}
			$link->close();
		}
		
		
		public function getComment()
		{
			$this->CountComments = 0;
			$link =new mysqli("localhost" , "exlogin" , "123456" , "forum");
						
						if($link === false)
						{
							die("ERROR: Could not connect. " . mysql_connect_error());
						}
						
						$query = "select * from comments";
						$result = $link -> query($query);
						//echo empty($result);
						
						 
						if(!empty($result))
						{
							while($row = mysqli_fetch_row($result))
							{
								$this->CountComments++;
								$title = $row[0];
								$author = $row[2];
								$this->comments[$this->CountComments]["body"] = $row[0];
								$this->comments[$this->CountComments]["question"] = $row[1];
								$this->comments[$this->CountComments]["answer"] = $row[2];
								$this->comments[$this->CountComments]["author"] = $row[3];
								$this->comments[$this->CountComments]["id"] = $row[4];
								
							}
						}
						else
						{
							echo "You can't logged in!";
							die();
						}
						
						$link -> close();
						return $this->comments;
		}
		
		public function getCountQuestions()
		{
			return $this->CountQuestions;
		}
		
		public function getCountAnswers()
		{
			return $this->CountAnswers;
		}
		
		public function getCountComments()
		{
			return $this->CountComments;
		}
		
		
	}




?>