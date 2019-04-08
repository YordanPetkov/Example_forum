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
	if($user->getUsername() != "GlobalAdmin")header('Location: mainPage.php');
	function DeleteM($NameM){
		//echo "DASDASDASDASD";
		$link =new mysqli("localhost" , "exlogin" , "123456" , "forum");
						
		if($link === false)
		{
			die("ERROR: Could not connect. " . mysql_connect_error());
		}
		
		$sql = "DELETE FROM members WHERE name = '$NameM'";
		echo $NameM ;
		if(mysqli_query($link, $sql)){
			//echo "Records were deleted successfully.";
		} 
		else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		
		// Close connection
		mysqli_close($link);
		header('Location: control_panel.php');
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
	$CountMembers = 0;
	$link =new mysqli("localhost" , "exlogin" , "123456" , "forum");
						
						if($link === false)
						{
							die("ERROR: Could not connect. " . mysql_connect_error());
						}
						
						$query = "select * from members";
						$result = $link -> query($query);
						//echo empty($result);
						
						 
						if(!empty($result))
						{
							while($row = mysqli_fetch_row($result))
							{
								$CountMembers++;
								$members[$CountMembers] = $row[0];
							}
						}
						else
						{
							echo "You can't logged in!";
							die();
						}
						
						$link -> close();
	
	
	
?>

	<table class = "Question_Table">
					<tr class = "Question_Row">
						<th>Number</th>
						<th>Name</th>
						<?php
							if($user -> getUsername() == "GlobalAdmin")echo "<th>Delete</th>";
						
						?>
					</tr>
		<?php
			for($i = 1; $i <= $CountMembers; $i++)
			{
				//echo "#" . $i . " " . $questions[$i]["title"] . "  from " . $questions[$i]["author"];
				//echo '<a href = "questionPage.php?quest=' . $i . '">#' . $i . '</a>';
				//echo " " . $questions[$i]["title"] . "  from " . $questions[$i]["author"];
				//echo "<br>";
				
		?>
			
				 
				
				
					<tr class = "Question_Row">
						<td><?php echo $i; ?> </td>
						<td><?php echo $members[$i]; ?></td>
					<?php
						if($user -> getUsername() == "GlobalAdmin"){
							?>
							<td><form method = "get">
								<input type = "hidden" name = "<?php echo $members[$i]; ?>">
								<input type = "submit" value = "Delete">
							</form></td>
							<?php
							//echo "<td class = 'Button'><button onclick = 'DeleteQ(" . $i . ")'>Delete</button>";
						}
					?>
					</tr>
				<?php
				
				
			}
			for($i = 1; $i <= $CountMembers; $i++){
				if(isset($_GET[$members[$i]]))
				{
					//echo "Cuknat e " . $i ;
					DeleteM($members[$i]);
					 
				}
			}
			
	
		?>
	</table>
		<footer>
			<p>Make by Yordan Petkov from Lesh Corp.</p>
		</footer>
	</body
</html>

	

	