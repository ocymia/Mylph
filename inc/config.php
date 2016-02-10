<?php
// Connexion à la DB
$dsn = 'mysql:host=127.0.0.1;dbname=mylph;charset=UTF8';
$user = 'root';
$password = 'toor';

// Effectuer la connexion
$pdo = new PDO($dsn, $user, $password);

//AUTO-MAILER FUNCTION
function autoMail($to, $subject, $messsageHTML, $messageText) {
	require_once 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.googlemail.com';  				// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'ginmax89@gmail.com';                 // SMTP username
	$mail->Password = file_get_contents('password.txt');  // SMTP password
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('admin@mylph.com', 'Your MYLPH');
	$mail->addAddress($to);
	//$mail->addBCC('webmaster or sumthin');

	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $subject;
	$mail->Body    = $messsageHTML;
	$mail->AltBody = $messageText;

	return $mail->send();
}


//DEFINE ABSOLUTE URL, NEED TO CHANGE THIS!!!!!!!!************************************************************
define('ABSOLUTE_URL', 'http://localhost/mylph/inc/');
?>