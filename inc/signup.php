<?php session_start() ?>
<html>
<head>
	<meta charset="utf-8">
	<title>SIGN UP</title>
</head>
<body>
<pre>
	<?php
		if (!empty($_SESSION)) {
			echo 'You are already signed in.<br/>';
			echo '<a href="../accueil.php">Continue</a>';
			exit;
			//redirect to whatever****************
		}
		if (!empty($_POST)) {
			//>GET DATA FROM $_POST AND FORMAT IT
			$emailSignup=isset($_POST['emailSignup'])? trim($_POST['emailSignup']):'';
			$passwordSignup1=isset($_POST['passwordSignup1'])? $_POST['passwordSignup1']:'';
			$passwordSignup2=isset($_POST['passwordSignup2'])? $_POST['passwordSignup2']:'';
			//Vérifications
			if ($passwordSignup1===$passwordSignup2 && !empty($passwordSignup1) && !empty($emailSignup) && filter_var($_POST['emailSignup'],FILTER_VALIDATE_EMAIL) && strlen($passwordSignup1)>7 && preg_match('/[A-Z]/',$passwordSignup1) && preg_match('/[0-9]/', $passwordSignup1)) {
				//REQUIRE CONNECTION TO DB
				require 'config.php';
				//CHECK IF EMAIL IS UNIQUE
				$emailCheck="
					SELECT usr_email
					FROM users
					WHERE usr_email= :emailCheck
				";
				$pdoStatement=$pdo->prepare($emailCheck);
				$pdoStatement->bindValue(':emailCheck',$emailSignup,PDO::PARAM_STR);
				$pdoStatement->execute();
				if ($pdoStatement->rowCount()>0) {
					echo $emailSignup.' is already taken. Try again.';
					exit;
				} else {
					//INSERT INTO DB
					$insertUser="
						INSERT INTO users(usr_email,usr_pwd)
						VALUES (:email,:password) 
					";
					$pdoStatement=$pdo->prepare($insertUser);
					$pdoStatement->bindValue(':email',$emailSignup,PDO::PARAM_STR);
					$pdoStatement->bindValue(':password',password_hash($passwordSignup1,PASSWORD_BCRYPT),PDO::PARAM_STR);
					//EXECUTE
					if ($pdoStatement->execute()) {
						echo 'You have signed up successfully<br/>';
						$_SESSION['login']=$emailSignup;
						$_SESSION['pwd']=password_hash($passwordSignup1,PASSWORD_BCRYPT);
					} else {
						echo 'Execution failed.<br/>';
					}
				}
			} else {
				echo 'E-mail and/or password in wrong format<br/>';
			}
		}
	?>
</pre>
<form action="" method="post">
	<fieldset>
		<legend>SIGN UP</legend>
		<input type="email" name="emailSignup" value="" placeholder="Email address" /><br/>
		<input type="password" name="passwordSignup1" value="" placeholder="Password" /><br/>
		<input type="password" name="passwordSignup2" value="" placeholder="Password" /><br/>
		<input type="submit" value="SUBMIT"/>
	</fieldset>
</form>

</body>
</html>