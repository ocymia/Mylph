<?php
require 'config.php';
?><html>
<head>
	<title>Change Password</title>
</head>
<body>
<?php
$emailClient = isset($_GET['email']) ? trim($_GET['email']) : '';
$token = isset($_GET['token']) ? trim($_GET['token']) : '';


$tokenOk = false;

if (!empty($token)) {
	$checkEmail = '
		SELECT usr_id, usr_pwd
		FROM users
		WHERE usr_email = :email
	';
	$pdoStatement = $pdo->prepare($checkEmail);
	$pdoStatement->bindValue(':email', $emailClient, PDO::PARAM_STR);
	//EXECUTE REQUEST
	if ($pdoStatement->execute() && $pdoStatement->rowCount() > 0) {

		$res = $pdoStatement->fetch();

		$tokenValid = md5($emailClient.'salty_mylph_overload'.$res['usr_pwd']);

		// COMPARE TOKENS
		if ($tokenValid === $token) {
			$tokenOk = true;
		}
		else {
			echo 'token invalid<br />';
		}
	}
	else {
		echo 'email does not exists<br />';
	}
}
else {
	echo 'token empty<br />';
}

// TODO : écrire le code permettant de récupérer les données en POST
// et de modifier le password du user

// On affiche le formulaire de changement de password qui si le token est valide
if ($tokenOk) {
?>
	<form action="" method="post">
		<fieldset>
			<legend>Change password</legend>
			<input type="hidden" name="email" value="<?php echo $emailClient; ?>" />
			<input type="password" name="passwordToto1" value="" placeholder="Your password" /> (8 caractères minimum)<br />
			<input type="password" name="passwordToto2" value="" placeholder="Confirm your password" /><br />
			<input type="submit" value="Change password"><br />
		</fieldset>
	</form>
<?php
}
?>
</body>
</html>