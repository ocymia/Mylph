
<html>
<head>
	<meta charset="utf-8">
	<title>LOGIN</title>
</head>
<body>
<?php require 'header.php'; ?>
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
					<a href="lost_password.php">LOST PASSWORD</a>
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
					//TWO REQUIRES ALREADY IN HEADER*************** FUCK CONFIG.PHP!!!!!!
					//require 'config.php';
					// functions.php should contain function for user verification with DB
					//require 'functions.php';

					//VERIFY PWD*********
					if (user_verif($emailLogin,$passwordLogin)) {
						//If login successful redirect to accueil.php and store id in session
						$idRequest="
							SELECT usr_id,roles_id
							FROM users
							WHERE usr_email='".$emailLogin."'"
						;
						$pdoStatement=$pdo->query($idRequest);
						$fetchId=$pdoStatement->fetch();
						$_SESSION['user_id']=$fetchId['usr_id'];
						$_SESSION['usr_role']=$fetchId['roles_id'];
						//FOR DEBUG PRINT_R:
						//print_r($_SESSION);
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