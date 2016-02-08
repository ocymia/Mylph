<?php


//Max
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

function add_location() {
	//sql to add a location
	$add_loc_sql ="";
	

}


?>