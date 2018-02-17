<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="mywebfont/stylesheet.css" type="text/css" charset="utf-8" />
		<title>Merci</title>
</head>
<body>
<div class="wrap">
			<div class="header">
				<h1>Merci <?php if(isset($_GET['prenom'])) {echo $_GET['prenom'];}?> pour votre requête !</h1>
			</div>
			<div class="logo">
				<p>
					<img src="images/hackers-poulette-logo.png" alt="hackers-poulette-logo">
				</p>
			</div>
</body>
</html>