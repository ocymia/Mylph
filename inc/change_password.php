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
		//store user id for later to update table:
		$userId=$res['usr_id'];
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
//GET NEW PASSWORD FROM $_POST AND CHECK IF VALID*******
if (!empty($_POST)) {
	$passwordChange1=isset($_POST['passwordChange1'])? $_POST['passwordChange1']:'';
	$passwordChange2=isset($_POST['passwordChange2'])? $_POST['passwordChange2']:'';
	//IF PWD VALID, DO THIS:
	if ($passwordChange1===$passwordChange2 && !empty($passwordChange1) && strlen($passwordChange1)>7 && preg_match('/[A-Z]/',$passwordChange1) && preg_match('/[0-9]/', $passwordChange1)) {
		//query to update pwd in database
		$updatePassword="
			UPDATE users
			SET usr_pwd= :newPassword
			WHERE usr_id=".$userId;
		$pdoStatement=$pdo->prepare($updatePassword);
		$pdoStatement->bindValue(':newPassword',password_hash($passwordChange1,PASSWORD_BCRYPT),PDO::PARAM_STR);
		//execute UPDATE to DB
		$pdoStatement->execute();
	}
}

//IF TOKEN VALID, SHOW FORM************
if ($tokenOk) {
?>
	<form action="" method="post">
		<fieldset>
			<legend>Change password</legend>
			<input type="hidden" name="email" value="<?php echo $emailClient; ?>" />
			<input type="password" name="passwordChange1" value="" placeholder="Your password" />Must contain, like, at least 8 chars...<br />
			<input type="password" name="passwordChange2" value="" placeholder="Confirm your password" />Here too!<br />
			<input type="submit" value="CHANGE PWD"><br />
		</fieldset>
	</form>
<?php
}
?>
</body>
</html>