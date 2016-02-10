<pre>
<?php
//maybe check if session  var role is the admin? (==2)
require 'config.php';
require 'functions.php';

echo '<a  class="backButton" href="accueil.php">Go Back</a><br><br>';

//show list of users
$getAllUsersSql = "SELECT * FROM users";
$pdoStatement = $pdo->query($getAllUsersSql);
$resList = $pdoStatement->fetchAll();

//print_r($resList);

//the trigger for role changes
if (!empty($_POST)) {
	//print_r($_POST);
	$temp = $_POST['u_id'];
	//sql to change user role from admin to user and vice versa
	$giveAdminSql = "UPDATE users SET roles_id=2 WHERE usr_id = :this";
	$removeAdminSql = "UPDATE users SET roles_id=1 WHERE usr_id = :this";
	//get current role
	$testRoleSql="SELECT roles_id FROM users WHERE usr_id = ".$temp;
	$pdoStatement=$pdo->query($testRoleSql);
	$PresList = $pdoStatement -> fetch();
	$role = $PresList['roles_id'];

	if ($role==1){
		$pdoStatement = $pdo->prepare($giveAdminSql);
		$pdoStatement->bindValue(':this', $_POST['u_id']);
		$pdoStatement->execute();
		header("Refresh: 0; url=admin_users.php");
		echo 'User is now Admin';
		exit;
	} else if ($role==2){
		$pdoStatement = $pdo->prepare($removeAdminSql);
		$pdoStatement->bindValue(':this', $_POST['u_id']);
		$pdoStatement->execute();
		header("Refresh: 0; url=admin_users.php");
		echo 'User is now a normal non-admin user';
		exit;
	}

	
}




//echo "<td><ul>";
foreach ($resList as $key => $value){
	$buttontext;
	echo $value['usr_id'].'&nbsp';
	echo $value['usr_nick'].'&nbsp';
	if ($value['roles_id']==1){echo "user".'&nbsp';$buttontext='Promote to Admin';}else{echo "admin".'&nbsp';$buttontext='Degrade to normal User';}
	echo $value['usr_email'].'&nbsp';

	echo '<form action="" method="post">';
	echo '<input type="hidden" name="u_id" value="'.$value['usr_id'].'"/>';
	echo '<input type="submit" name="'.$value['usr_id'].'" value="'.$buttontext.'"/>';
	echo '</form>';
}

//echo "<li>".""."</li>";
//when selected auto fill in a form where you can change the role


?>
</pre>