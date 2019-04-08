
<?php/*
	потребител :
		ник
		парола
		въпроси
		отговори
		коментари
		
	въпроси :
		заглавие
		тяло
		автор
		отговори
		
	отговор :
		към кой въпрос
		тяло
		автор
		коментари
		
	коментар :
		към кой отговор
		тяло
		автор
	
	форум
		въпроси
			отговори
				коментари


*/?>
<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" href = "styles/styles.css">
	</head>
	<body>
		<header>
			<h1>Welcome to <i>"Lesh Prikazvalnik"</i></h1>
			<ul class = "Navigation">
			<li class = "Button"><a href = "pages/login.php">Login</a></li>
			<li class = "Button"><a href = "pages/create.php">Registration</a></li>
		</ul>
		</header>
		
		<div class = "Index_description">
			<h2>You can ask questions , answers to other questions and comment to sb's answer.</h2>
		</div>
		
		<footer>
		<p>Make by Yordan Petkov from Lesh Corp.</p>
		</footer>
	</body
</html>