
<!DOCTYPE html>
<html>
<head>
<!-- asfsafdasdfsadfsafdasf  -->
	<title>User sign up</title>
</head>
<body>
<pre>
<?php
if(!empty($_POST)){
		print_r($_POST);
		$email = isset($_POST['emailToto']) ? trim($_POST['emailToto']) : '';
		$passwordToto1 = isset($_POST['passwordToto1']) ? trim($_POST['passwordToto1']) : '';
		$passwordToto2 = isset($_POST['passwordToto2']) ? trim($_POST['passwordToto2']) : '';
		// je fais les verifications
		if ($passwordToto1 === $passwordToto2 && !empty($passwordToto1) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

			// Require la DB
				Require 'config.php';

			// verifie si adresse Email n'existe pas
				$checkEmail ='
				SELECT usr_email
				FROM user
				WHERE ust_email = :quelquechose
				';
			

				$pdoStatementSelect = $pdo->prepare($checkEmail);
				$pdoStatement->bindValue(':quelquechose', $email,PDO::PARAM_STR);
				if ($pdoStatement->execute()){

				// verifie si adresse Email existe
				if ($pdoStatementSelect && $pdoStatementSelect->rowCount()> 0){
					echo 'email"'.$contactsListInfos['email'].'" existant<br/>';
				}
					// si adresse Email n'existe pas alors on introduit dans la table contacts
				else{
					
					

					// j'insere en DB
					$insertUser = '
					INSERT INTO user (usr_email, usr_password, usr_date_creation)
					VALUES (:email, :password, NOW())';

					$pdoStatement = $pdo->prepare($insertUser);
					$pdoStatement->bindValue(':email', $email,PDO::PARAM_STR);
				//	$pdoStatement->bindValue(':password', md5($passwordToto1.'her'),PDO::PARAM_STR);
					$pdoStatement->bindValue(':password', password_hash($passwordToto1, PASSWORD_BCRYPT),PDO::PARAM_STR);


					 // J'exécute

					 if ($pdoStatement->execute()){
					 	echo 'user signed up<br/>';
					 }
					 else{
					 	echo 'ouch<br/>';
					 }
				}
		
		}
		else{
				echo ' email and/or password are wrong<br/>';
		}
}	

?>
</pre>
<form action ="" method="post"> 
  <fieldset>
  	<legend>User sign up</legend>
  	<input type="email" name="emailToto" value="" placeholder="Email address" /><br/>
  	<input type="password" name="passwordToto1" value="" placeholder="your password" /><br/>
  	<input type="password" name="passwordToto2" value="" placeholder="confirme our password" /><br/>
  	<input type="submit" value"sign up"/>
  </fieldset>
</form>
</body>
</html>