<?php
	require_once '../classes/Forum.php';
	require_once '../classes/archive/questions.php';
	require_once '../classes/archive/answers.php';
	require_once '../classes/archive/comments.php';
	require_once '../classes/author/User.php';
	$myForum = new Forum();
	
	if(!session_id()) session_start();
			
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
			<li class = "Text">You are not logged in!</li>
			<li class = "Button"><a href = "create.php">Registration</a></li>
		</ul>
		</header>
		
		<div class = "Client_box">
			<h2>Login to Lesh Prikazvalnik</h2>
			<form method="post" class = "Client_form">
				Nickname<input type = "text" name = "user" required>
				<br/>
				Password <input type = "password" name = "pass" required>
				<br/>
				<input class = "Button" type = "submit" value = "Login">
			</form>
		</div>
			
			<?php
				if(isset($_POST["user"]) && (isset($_POST["pass"])))
				{
					$name = $_POST["user"];
					$pass = $_POST["pass"];
					$nocryptpass = strrev($pass);
					$nocryptpass = str_rot13($nocryptpass);
					$nocryptpass = md5($nocryptpass);
					$pass =  crypt ( $nocryptpass , strrev($name)  );
					if(!preg_match("/^[a-zA-Z0-9]*$/",$name) || (!preg_match("/^[a-zA-Z0-9]*$/",$pass)))
					{
						echo "<p><strong>Invalid username or password</strong></p> <br>";
						echo "Only letters and numbers allowed!";
					}
				
					else
					{
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
								
								if($row[0] == $name && $row[1] == $pass)
								{
									$user = new User($name);
									$myForum->setCurrentUser($user);
									$_SESSION['myForum'] = $myForum;
									header('Location: mainPage.php');
									echo "You are logged in!";
								}
								
							}
							
						}
						else
						{
							die("You can't logged in!");
						}
						$link -> close();
					}
				}
				
				
			?>
			
		
		
		<footer>
		<p>Make by Yordan Petkov from Lesh Corp.</p>
		</footer>
	</body
</html>
			






