<?php

// fonction qui utilise l'API geocode de google, recoit une addresse et renvoie un tableau contenant l'adresse formattée, la laitude et la longitude
function geocode($address){
	$address = str_replace(" ", "+", $address);
	$geoloc = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&sensor=false"));
	$coord[0] = $geoloc->results[0]->formatted_address;
	$coord[1] = $geoloc->results[0]->geometry->location->lat;
	$coord[2] = $geoloc->results[0]->geometry->location->lng;
	return $coord;
}

function user_verif($emailLogin,$passwordLogin){
	GLOBAL $pdo;
	$checkUser="
		SELECT *
		FROM user
		WHERE usr_email = :user
	";
	$pdoStatement = $pdo->prepare($checkUser);
	$pdoStatement->bindValue(':user',$emailLogin,PDO::PARAM_STR);
	if ($pdoStatement->execute()) {
		if ($pdoStatement->rowCount()>0) {
			//GET HASHED PWD
			$res=$pdoStatement->fetch();
			$passwordHashed=$res['usr_password'];
			//PWD CHECK
			if (password_verify($passwordLogin,$passwordHashed)) {
				$_SESSION['login']=$emailLogin;
				$_SESSION['pwd']=$passwordHashed;
				return true;
			} else {
				echo 'wrong password';
			}
		} else {
			echo 'sign in failed<br/>';
		}
	} else {
		echo 'query failed<br/>';
	}
}

?>
