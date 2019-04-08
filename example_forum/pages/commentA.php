
<?php
	require_once '../classes/Forum.php';
	require_once '../classes/archive/questions.php';
	require_once '../classes/archive/answers.php';
	require_once '../classes/archive/comments.php';
	require_once '../classes/author/User.php';
	
	if(!session_id()) session_start();
	$myForum = $_SESSION['myForum'];
	$_SESSION['NumberOfQuestion'][1] = $_GET['ans'];
	$NumberOfQuestion = $_SESSION['NumberOfQuestion'];
	$user = $myForum -> getCurrentUser();
	
	$questions = $myForum-> getQuestions();
	$questTitle = $questions[$NumberOfQuestion[0]]['title'];
	$questBody = $questions[$NumberOfQuestion[0]]['body'];
	$questAuthor = new User($questions[$NumberOfQuestion[0]]['author']);
	$questId = $questions[$NumberOfQuestion[0]]['id'];
	
	$answers = $myForum-> getAnswer();
	$ansBody = $answers[$NumberOfQuestion[1]]['body'];
	$ansAuthor = new User($answers[$NumberOfQuestion[1]]['author']);
	$ansId = $answers[$NumberOfQuestion[1]]['id'];
	
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
		
		
		<div class = "Client_box">
			<h2>Comment to <?php echo $questTitle; ?></h2>
			<form method = "post" class = "Client_form">
				<textarea name="body" rows = "15" cols = "30" placeholder = "body" required></textarea>
				<br>
				<input type = "submit" name = "ask" value = "Comment">
			</form>
		</div>
		
		<footer>
			<p>Make by Yordan Petkov from Lesh Corp.</p>
		</footer>
	</body
</html>


<?php
	if(isset($_POST["body"]))
	{
		$ansQuest = new Question ($questTitle,$questBody,$questAuthor,$questId);
		$answer = new Answer ($ansQuest,$ansBody,$ansAuthor,$ansId);
		$body = $_POST["body"];
		$author = $myForum->getCurrentUser();
		$id = $myForum->getCountComments();
		$myComment = new Comment($answer,$body,$author,$id);
		
		$myForum -> setComment($myComment);
		header('Location: questionPage.php?quest=' . $NumberOfQuestion[0]);
	}

?>