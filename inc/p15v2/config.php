<?php
session_start();

// Connexion à la DB
$dsn = 'mysql:dbname=auth;host=localhost;charset=UTF8';
$user = 'root';
$passwordDb = 'totowf3';
// Effectuer la connexion
$pdo = new PDO($dsn, $user, $passwordDb);

// Un define, une constante
define('ABSOLUTE_URL', 'http://localhost/p15/');

function checkUser($userEmail, $userPassword, $alreadyHashed=false) {
	global $pdo;
	// Je prépare ma requête
	$checkUser = '
		SELECT *
		FROM user
		WHERE usr_email = :user
	';
	$pdoStatement = $pdo->prepare($checkUser);
	$pdoStatement->bindValue(':user', $userEmail, PDO::PARAM_STR);

	// J'exécute
	if ($pdoStatement->execute()) {
		if ($pdoStatement->rowCount() > 0) {
			// Je récupère le mot de passe
			$res = $pdoStatement->fetch();
			$passwordHashed = $res['usr_password'];
			$userRole = $res['usr_role'];

			// Si le mot de passe fourni est déjà haché
			if ($alreadyHashed) {
				if ($userPassword == $passwordHashed) {
					return true;
				}
			}
			// Je check le mot de passe haché
			else {
				if (password_verify($userPassword, $passwordHashed)) {
					// On mets les variables en session
					$_SESSION['sess_login'] = $userEmail;
					$_SESSION['sess_password'] = $passwordHashed;
					$_SESSION['sess_role'] = $userRole;

					return true;
				}
			}
		}
	}
	return false;
}

function autoMail($to, $subject, $messsageHTML, $messageText) {
	require_once 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.googlemail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'neby55@gmail.com';                 // SMTP username
	$mail->Password = file_get_contents('password.txt');  // SMTP password
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('neby55@gmail.com', 'ben wf3');
	$mail->addAddress($to);
	//$mail->addBCC('webmaster@monsite.lu');

	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $subject;
	$mail->Body    = $messsageHTML;
	$mail->AltBody = $messageText;

	return $mail->send();
}