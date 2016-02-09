<?php
//initialize db location types
//conenction details for db // contains $pdo
require '../inc/config.php';


$rowcount_roles = "SELECT * FROM roles";
$pdoCount = $pdo->query($rowcount_roles);


if ($pdoCount->rowCount() == 0){
	//create roles
	$sqlroles="
		INSERT INTO roles (roles_id,roles_name)
		VALUES (1,'User'),(2,'Admin')
	";
	$pdoStatement = $pdo->query($sqlroles);
} else {
	//do nothin - types seem to exist already
}


?>
