<?php

require 'config.php';
?><html>
<head>
	<title>Password forgotten</title>
</head>
<body>
<?php

// IF SUBMIT
if (!empty($_POST)) {
	$email = isset($_POST['emailLostPassword']) ? trim($_POST['emailLostPassword']) : '';

	// CHECK IF EMAIL VALID
	if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
		$checkEmail = '
			SELECT usr_id, usr_pwd
			FROM users
			WHERE usr_email = :email
		';
		$pdoStatement = $pdo->prepare($checkEmail);
		$pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);
		if ($pdoStatement->execute() && $pdoStatement->rowCount() > 0) {
			$res = $pdoStatement->fetch();
			// CREATE USER TOKEN (ITS USER EMAIL + SALT + USER PASSWORD)
			$token = md5($email.'salty_mylph_overload'.$res['usr_pwd']);

			$emailHTML = '<a href="'.ABSOLUTE_URL.'change_password.php?email='.$email.'&token='.$token.'">Click here to change your password</a>';
			$emailText = 'Go here : '.ABSOLUTE_URL.'change_password.php?email='.$email.'&token='.$token;
			$subject = 'Lost password on MYLPH';
			// SEND EMAIL
			if (autoMail($email, $subject, $emailHTML, $emailText)) {
				echo 'An email has been sent to '.$email.'<br />';
			}
			else {
				echo 'E-mail could not been sent.<br />';
			}
		}
		else {
			echo 'Sorry, this email does not exist<br />';
		}
	}
	else {
		echo 'Invalid E-mail adress<br />';
	}
}

?>
	<form action="" method="post">
		<fieldset>
			<legend>Lost password</legend>
			<input type="email" name="emailLostPassword" value="" placeholder="Email address" /><br />
			<input type="submit" value="Change password"><br />
		</fieldset>
	</form>

</body>
</html>