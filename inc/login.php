<?php
session_start();
?>
<html>
<head>
	<meta charset="utf-8">
	<title>LOGIN</title>
</head>
<body>

<pre>
	<?php
		//FIRST CHECK IF USER IS ALREADY LOGGED IN**************
		if (!empty($_SESSION)) {
			//IF SESSION EXISTS REDIRECT TO ACCUEIL.PHP
			header("Location: accueil.php");
			exit;
		} else {
			//if not logged in show login form
			?> 
			<form action="" method="post">
				<fieldset>
					<legend>LOGIN</legend>
					<input type="email" name="emailLogin" value="" placeholder="Email address" /><br/>
					<input type="password" name="passwordLogin" value="" placeholder="Password" /><br/>
					<input type="submit" value="LOG IN">
				</fieldset>
			</form>
			<?php
			//WHEN FORM SUBMITTED DO THIS (CHECK):
			if (!empty($_POST)) {
				//GET DATA FROM $_POST
				$emailLogin=isset($_POST['emailLogin'])? trim($_POST['emailLogin']):'';
				$passwordLogin=isset($_POST['passwordLogin'])? trim($_POST['passwordLogin']):'';
				//VERIFICATION
				if (!empty($emailLogin)&&!empty($passwordLogin)) {
					//require connection to DB in config
					require 'config.php';
					// functions.php should contain function for user verification with DB
					require 'functions.php';

					//VERIFY PWD*********
					if (user_verif($emailLogin,$passwordLogin)) {
						//If login successful redirect to accueil.php
						header("Location: accueil.php");
						exit;
					}
				} else {
					echo 'E-mail and/or password field(s) empty.<br/>';
				}
			}
		}
	?>
</pre>



</body>
</html>