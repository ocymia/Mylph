<?php
require 'config.php';
?><html>
<head>
	<title>Change Password</title>
</head>
<body>
<?php
//_GET email and token linked from email*******
$emailClient = isset($_GET['email']) ? trim($_GET['email']) : '';
$token = isset($_GET['token']) ? trim($_GET['token']) : '';


$tokenOk = false;

if (!empty($token)) {
	//check user email in db request
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

		$tokenValid = md5($emailClient.'salty_mylph'.$res['usr_pwd']);

		// COMPARE TOKENS
		if ($tokenValid === $token) {
			//PERMITS TO SHOW FORM LATER IF TOKEN OK
			$tokenOk = true;
		}
		else {
			echo 'GET A REAL TOKEN, BRAH!<br />';
		}
	}
	else {
		echo 'NO SUCH EMAIL<br />';
	}
}
else {
	echo "WHERE'S YOUR TOKEN DUDE?!<br />";
}


//IF TOKEN VALID, SHOW FORM************
if ($tokenOk) {
?>
	<form action="" method="post">
		<fieldset>
			<legend>Change password</legend>
			<input type="hidden" name="email" value="<?php echo $emailClient; ?>" />
			<input type="password" name="passwordToto1" value="" placeholder="Your password" />Must contain, like, at least 8 chars or sumthin...<br />
			<input type="password" name="passwordToto2" value="" placeholder="Confirm your password" />Here too!<br />
			<input type="submit" value="Change password"><br />
		</fieldset>
	</form>
<?php
}
?>
</body>
</html>