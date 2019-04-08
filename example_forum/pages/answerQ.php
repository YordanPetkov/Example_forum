
<?php
	require_once '../classes/Forum.php';
	require_once '../classes/archive/questions.php';
	require_once '../classes/archive/answers.php';
	require_once '../classes/archive/comments.php';
	require_once '../classes/author/User.php';
	
	if(!session_id()) session_start();
	$NumberOfQuestion = $_SESSION['NumberOfQuestion'];
	$myForum = $_SESSION['myForum'];
	$user = $myForum -> getCurrentUser();
	$questions = $myForum-> getQuestions();
	$questTitle = $questions[$NumberOfQuestion[0]]['title'];
	$questBody = $questions[$NumberOfQuestion[0]]['body'];
	$questAuthor = new User($questions[$NumberOfQuestion[0]]['author']);
	$questId = $questions[$NumberOfQuestion[0]]['id'];
	
	
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
			<h2>Answer to "<?php echo $questTitle  ?>"</h2>
			<form method = "post" class = "Client_form">
				
				<textarea name="body" rows = "15" cols = "30" placeholder = "body" required></textarea>
				<br>
				<input type = "submit" name = "answer" value = "Answer">
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
		$question = new Question ($questTitle,$questBody,$questAuthor,$questId);
		$body = $_POST["body"];
		$author = $myForum->getCurrentUser();
		$id = $myForum->getCountQuestions();
		$myAnswer = new Answer($question,$body,$author,$id);
		
		$myForum -> setAnswer($myAnswer);
		header('Location: questionPage.php?quest=' . $NumberOfQuestion[0]);
	}

?>