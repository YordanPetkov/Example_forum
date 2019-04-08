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
	function DeleteQ($NumberQ){
		//echo "DASDASDASDASD";
		$link =new mysqli("localhost" , "exlogin" , "123456" , "forum");
						
		if($link === false)
		{
			die("ERROR: Could not connect. " . mysql_connect_error());
		}
		//$sql = "DELETE  E FROM (SELECT  rn = ROW_NUMBER() OVER (ORDER BY ) FROM questions)
		//AS E WHERE   E.rn = $NumberQ";		
		//echo "cukna $NumberQ";		
		$sql = "DELETE FROM questions WHERE id = $NumberQ";
		
		if(mysqli_query($link, $sql)){
			//echo "Records were deleted successfully.";
		} 
		else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		
		$sql = "DELETE FROM comments WHERE questions = $NumberQ";
		if(mysqli_query($link, $sql)){
			//echo "Records were deleted successfully.";
		} 
		else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		
		$sql = "DELETE FROM answers WHERE question = $NumberQ";
		if(mysqli_query($link, $sql)){
			//echo "Records were deleted successfully.";
		} 
		else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		// Close connection
		mysqli_close($link);
		header('Location: mainPage.php');
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
			<li class = "Button"><a href = "askQ.php">Ask a question</a></li>
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
<?php
	
	if(!session_id()) session_start();
	$myForum = $_SESSION['myForum'];
	
	$questions = $myForum->getQuestions();
	
	$CountQuestions = $myForum->getCountQuestions();
	
	
	
?>

	<table class = "Question_Table">
					<tr class = "Question_Row">
						<th>Number</th>
						<th>Title</th>
						<th>Author</th>
						<th>Delete</th>
					</tr>
		<?php
			for($i = 1; $i <= $CountQuestions; $i++)
			{
				//echo "#" . $i . " " . $questions[$i]["title"] . "  from " . $questions[$i]["author"];
				//echo '<a href = "questionPage.php?quest=' . $i . '">#' . $i . '</a>';
				//echo " " . $questions[$i]["title"] . "  from " . $questions[$i]["author"];
				//echo "<br>";
				
		?>
			
				 
				
				
					<tr class = "Question_Row">
						<td class = "Link"><a href = "questionPage.php?quest=<?php echo $i; ?>"><?php echo $i; ?></a></td>
						<td class = "Link"><a href = "questionPage.php?quest=<?php echo $i; ?>"><?php echo $questions[$i]["title"]; ?></a></td>
						<td><?php echo $questions[$i]["author"]; ?></td>
						<td>
					<?php
						if($user -> getUsername() == "GlobalAdmin" || $user -> getUsername() == $questions[$i]["author"]){
							?>
							<form method = "get">
								<input type = "hidden" name = "<?php echo $i ?>">
								<input type = "submit" value = "Delete">
							</form>
							<?php
							//echo "<td class = 'Button'><button onclick = 'DeleteQ(" . $i . ")'>Delete</button>";
						}
					?>
						</td>
					</tr>
				<?php
				
				
			}
			for($i = 1; $i <= $CountQuestions; $i++){
				if(isset($_GET[$i]))
				{
					//echo "Cuknat e " . $i ;
					DeleteQ($i);
					 
				}
			}
			
	
		?>
	</table>
		<footer>
			<p>Make by Yordan Petkov from Lesh Corp.</p>
		</footer>
	</body
</html>

	

	