<pre>
<?php
//maybe check if session  var role is the admin? (==2)
require 'config.php';
require 'functions.php';

//show list of users
$getAllUsersSql = "SELECT * FROM users";
$pdoStatement = $pdo->query($getAllUsersSql);
$resList = $pdoStatement->fetchAll();

print_r($resList);

echo "<td><ul>";

foreach ($resList as $key => $value){
	echo $value['usr_id'];
	echo $value['usr_nick'];
	if ($value['roles_id']==1){echo "user";}else{echo "admin";}
	echo $value['usr_email'];
	if ($value['roles_id']==1){
		//echo '<a href="">give admin</a>';
		echo '<form action="" method="post">';
		echo '<input type="submit" name="give_admin" value="give admin"/>';
		echo '</form>';


	}else{
		//echo '<a href="">remove admin</a>';

	}
	echo "<br>";
}

echo "<li>".""."</li>";
//when selected auto fill in a form where you can change the role


?>
</pre>