<?php require 'header.php'; ?>
<pre>
	<?php
		if (!empty($_SESSION)) {
			//IF SESSION EXITS REDIRECT TO ACCUEIL
			header("Location: accueil.php");
			exit;
		}
		if (!empty($_POST)) {
			//>GET DATA FROM $_POST AND FORMAT IT
			$emailSignup=isset($_POST['emailSignup'])? trim($_POST['emailSignup']):'';
			$passwordSignup1=isset($_POST['passwordSignup1'])? $_POST['passwordSignup1']:'';
			$passwordSignup2=isset($_POST['passwordSignup2'])? $_POST['passwordSignup2']:'';
			$nickName=$_POST['nickName'];
			$userRole=$_POST['role'];
			//Vérifications
			if ($passwordSignup1===$passwordSignup2 && !empty($passwordSignup1) && !empty($emailSignup) && filter_var($_POST['emailSignup'],FILTER_VALIDATE_EMAIL) && strlen($passwordSignup1)>7 && preg_match('/[A-Z]/',$passwordSignup1) && preg_match('/[0-9]/', $passwordSignup1)) {
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
						INSERT INTO users(usr_email,usr_pwd,usr_nick,roles_id)
						VALUES (:email,:password,:nick,:role) 
					";
					$pdoStatement=$pdo->prepare($insertUser);
					$pdoStatement->bindValue(':email',$emailSignup,PDO::PARAM_STR);
					$pdoStatement->bindValue(':password',password_hash($passwordSignup1,PASSWORD_BCRYPT),PDO::PARAM_STR);
					$pdoStatement->bindValue(':nick',$nickName,PDO::PARAM_STR);
					$pdoStatement->bindValue(':role',$userRole,PDO::PARAM_INT);
					//EXECUTE
					if ($pdoStatement->execute()) {
						//echo 'You have signed up successfully<br/>';
						//store user id in session for further use
						$idRequest="
							SELECT usr_id,roles_id
							FROM users
							WHERE usr_email='".$emailSignup."'"
						;
						$pdoStatement=$pdo->query($idRequest);
						$fetchId=$pdoStatement->fetch();
						$_SESSION['user_id']=$fetchId['usr_id'];
						$_SESSION['usr_role']=$fetchId['roles_id'];
						header("Location: accueil.php");
						exit;
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
		<input type="text" name="nickName" value="" placeholder="Nickname" /><br/>
		<input type="hidden" name="role" value="1" /><br/>
		<input type="submit" value="SUBMIT"/>
	</fieldset>
</form>

</body>
</html>