

<?php
	require_once '../classes/Forum.php';
	require_once '../classes/archive/questions.php';
	require_once '../classes/archive/answers.php';
	require_once '../classes/archive/comments.php';
	require_once '../classes/author/User.php';
	$_SESSION['NumberOfQuestion'][1] = 1;
	if(!session_id()) session_start();
	$myForum = $_SESSION['myForum'];
	$user = $myForum -> getCurrentUser();
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
			<h2>Ask a question in Lesh Prikazvalnik</h2>
			<form method = "post" class = "Client_form">
				<textarea name="title" rows = "4" cols = "30" placeholder = "title" required></textarea>
				<br>
				<textarea name="body" rows = "15" cols = "30" placeholder = "body" required></textarea>
				<br>
				<input type = "submit" name = "ask" value = "Ask">
			</form>
		</div>
		
		<footer>
			<p>Make by Yordan Petkov from Lesh Corp.</p>
		</footer>
	</body
</html>
<?php
	if(isset($_POST["title"]) && isset($_POST["body"]))
	{
		if(!session_id()) session_start();
		$myForum = $_SESSION['myForum'];
		$author = $myForum->getCurrentUser();
		
		$body = $_POST["body"];
		$title = $_POST["title"];
		$id = $myForum -> getCountQuestions() + 1;
		//echo $myForum -> getCountQuestions();
		if($body == "" || $title == ""){header('Location: askQ.php');}
		$question = new Question($title,$body,$author,$id);
		
		$myForum->setQuestion($question);
		header('Location: mainPage.php');
	}
	

?>

		