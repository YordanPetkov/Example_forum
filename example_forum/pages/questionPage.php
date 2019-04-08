<?php
	require_once '../classes/Forum.php';
	require_once '../classes/archive/questions.php';
	require_once '../classes/archive/answers.php';
	require_once '../classes/archive/comments.php';
	require_once '../classes/author/User.php';
	
	if(!session_id()) session_start();
	$_SESSION['NumberOfQuestion'][1] = 1;
	$myForum = $_SESSION['myForum'];
	$user = $myForum -> getCurrentUser();
	
	function DeleteQAC($NumberQ,$NumberA,$NumberC,$type){
		//echo "DASDASDASDASD";
		echo $NumberQ;
		$link =new mysqli("localhost" , "exlogin" , "123456" , "forum");
						
		if($link === false)
		{
			die("ERROR: Could not connect. " . mysql_connect_error());
		}		
		if($type == "question")$sql = "DELETE FROM questions WHERE id = $NumberQ";
		if($type == "answer")$sql = "DELETE FROM answers WHERE id = $NumberA";
		if($type == "comment")$sql = "DELETE FROM comments WHERE id = $NumberC";
		if(mysqli_query($link, $sql)){
			//echo "Records were deleted successfully.";
		} 
		else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		
		if($type == "question")$sql = "DELETE FROM answers WHERE question = $NumberQ";
		if($type == "answer")$sql = "DELETE FROM comments WHERE answer = $NumberC AND questions = $NumberQ";
		if(mysqli_query($link, $sql)){
			//echo "Records were deleted successfully.";
		} 
		else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		if($type == "question")$sql = "DELETE FROM comments WHERE question = $NumberQ";
		if(mysqli_query($link, $sql)){
			//echo "Records were deleted successfully.";
		} 
		else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		
		// Close connection
		mysqli_close($link);
		
		if($type != "question")header('Location: questionPage.php?quest=$NumberQ');
		else header('Location: mainPage.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" href = "../styles/styles.css">
	</head>
	<body>
		<header>
			<h1>Welcome to <i>"Lesh Prikazvalnik"</i></h1>
			<ul class = "Navigation">
				<li class = "Text"><?php echo $user->getUsername() ?></li>
				<li class = "Button"><a href = "mainPage.php">Back to questions</a></li>
				<?php 
				if($user->getUsername() == "GlobalAdmin")
				{
					?>
					<li class = "Button"><a href = "control_panel.php">Control Panel</a></li>
					<?php
				}
				?>
				<li class = "Button"><a href = "login.php">Logout</a></li>
			</ul>
		</header>
		
		
		<div class = "Client_box_Questions">
			
		
		
		
	<?php 

		
		if(!session_id()) session_start();
		$myForum = $_SESSION['myForum'];
		
		$questions = $myForum->getQuestions();
		
		$NumberOfQuestion = $_GET["quest"];
		
									
		?>
		<ul class = "List_Construction">
			<li>Question :
				<ul>
					<li  class = "Title">
						<?php echo $questions[$NumberOfQuestion]['title']; ?>
					</li>
					<li class = "Body">
						<?php echo  $questions[$NumberOfQuestion]['body']; ?>
					</li>
					<li class = "Author">
						<?php echo "Author : " . $questions[$NumberOfQuestion]['author'] ; ?>
					</li>
					<li 
						class = "Button"><a href = "answerQ.php">Answer</a>
					</li>
					<?php
						if($user -> getUsername() == "GlobalAdmin" || $user -> getUsername() == $questions[$NumberOfQuestion]["author"]){
							?>
							<li>
							<form method = "post">
								<input type = "hidden" name = "question">
								<input type = "submit" value = "Delete">
							</form>
							</li>
							<?php
							
							//echo "<td class = 'Button'><button onclick = 'DeleteQ(" . $i . ")'>Delete</button>";
						}
					?>
				</ul>
			</li>
		</ul>
		<ul class = "List_Construction">
			<li>Answers :
			<?php
			
			$_SESSION['NumberOfQuestion'][0] = $NumberOfQuestion;
			 //$NumberOfAnswer = $_SESSION['NumberOfQuestion'][1];
			
			$answers = $myForum->getAnswer();
			$comments = $myForum->getComment();
			$CountAnswers = $myForum->getCountAnswers();
			$CountComment = $myForum->getCountComments();
			$j = 0;
			for($i = 1 ; $i <= $CountAnswers; $i++)
			{
				
				if($answers[$i]['question'] == $NumberOfQuestion)
				{
					
					$j++;
				?>
				<ul>
					<li  class = "Title">
						<?php echo "Answer : " . $j; ?>
					</li>
					<li class = "Body">
						<?php echo  $answers[$i]["body"]; ?>
					</li>
					<li class = "Author">
						<?php echo "Author : " . $answers[$i]["author"] ; ?>
					</li>
					<li
						class = "Button"><a href = "commentA.php<?php echo '?ans=' . $j;?>">Comment</a>
					</li>
					<?php
						if($user -> getUsername() == "GlobalAdmin" || $user -> getUsername() == $answers[$i]["author"]){
							?>
							<li>
							<form method = "post">
								<input type = "hidden" name = "<?php $answers[$i]["id"] ?>">
								<input type = "hidden" name = "answer">
								<input type = "submit" value = "Delete">
							</form>
							</li>
							<?php
							
							//echo "<td class = 'Button'><button onclick = 'DeleteQ(" . $i . ")'>Delete</button>";
						}
					?>
				</ul>
			
		<ul class = "List_Construction">
			<li>Comments :
					
				<?php
				/*echo "Answer $j : <br>";
				echo "--------------Body : " . $answers[$i]["body"];
				echo "<br>";
				echo "--------------Author : " . $answers[$i]["author"];
				echo "<br>";
				echo '<a href = "commentA.php?ans=' . $j . '">comment</a>';
				echo "<br>";
				
				echo "Comments : ";echo "<br>";*/
					for($k = 1 ; $k <= $CountComment; $k++)
					{
						
						if($comments[$k]['question'] == $NumberOfQuestion && $comments[$k]['answer'] == $j)
						{
							?>
							<ul>
								<li class = "Body">
									<?php echo  $comments[$k]["body"]; ?>
								</li>
								<li class = "Author">
									<?php echo "From " . $comments[$k]["author"] ; ?>
								</li>
								<?php
								if($user -> getUsername() == "GlobalAdmin" || $user -> getUsername() == $answers[$i]["author"]){
									?>
									<li>
									<form method = "post">
										<input type = "hidden" name = "<?php $comments[$k]['id'] ?>">
										<input type = "hidden" name = "comment">
										<input type = "submit" value = "Delete">
									</form>
									</li>
									<?php
									
									//echo "<td class = 'Button'><button onclick = 'DeleteQ(" . $i . ")'>Delete</button>";
								}
					?>
							</ul>
							<br/>
						
					<?php
							/*echo "----------------------------Body : " . $comments[$k]["body"];
							echo "<br>";
							echo "----------------------------Author : " . $comments[$k]['author'];
							echo "<br>";*/
							
							
						}
						
					}
					
					
			
			?>
			</li>
		</ul>
		<br/><br/>
			<?php
				
				
			}
		}
		
		
	?>	
		
			</li>
		</ul>
			</div>
			
			<?php 

					
						for($k = 1 ; $k <= $CountComment; $k++)	
							if(isset($_POST["comment"]) && isset($_POST[$comments[$k]['id']]))
							{
								//echo $k . " " . $j;die();
								DeleteQAC($$comments[$k]['question'],$comments[$k]['answer'],$comments[$k]['id'],"comment");
							}
							$j = 0;
						for($i = 1 ; $i <= $CountAnswers; $i++){
							if($answers[$i]["question"] == $NumberOfQuestion)$j++;
							if(isset($_POST["answer"]) &&  isset($answers[$i]["id"] ) )
							{
								DeleteQAC($NumberOfQuestion,$answers[$i]["id"] ,$j,"answer");
							}
						}
						if(isset($_POST["question"]) )
						{
							DeleteQAC($NumberOfQuestion,$NumberOfQuestion,$NumberOfQuestion,"question");
						}

				?>
		<footer>
			<p>Make by Yordan Petkov from Lesh Corp.</p>
		</footer>
	</body
</html>


								
