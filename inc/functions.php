<?php


//Max
function user_verif($emailLogin,$passwordLogin){
	GLOBAL $pdo;
	$checkUser="
		SELECT *
		FROM users
		WHERE usr_email = :userEmail
	";
	$pdoStatement = $pdo->prepare($checkUser);
	$pdoStatement->bindValue(':userEmail',$emailLogin,PDO::PARAM_STR);
	if ($pdoStatement->execute()) {
		if ($pdoStatement->rowCount()>0) {
			//GET HASHED PWD
			$res=$pdoStatement->fetch();
			$passwordHashed=$res['usr_pwd'];
			//PWD CHECK
			if (password_verify($passwordLogin,$passwordHashed)) {
				//$_SESSION['login']=$emailLogin;
				//$_SESSION['pwd']=$passwordHashed;
				return true;
			} else {
				echo 'Wrong password.<br/>';
			}
		} else {
			echo 'Sign in failed<br/>';
		}
	} else {
		echo 'Query failed<br/>';
	}
}

function add_location() {
	//sql to add a location
	$add_loc_sql ="";
	

}


?>