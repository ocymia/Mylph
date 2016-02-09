<pre>
<?php
//maybe check if session  var role is the admin? (==2)
require 'header.php';

//show list of users
$getAllLocationsSql = "SELECT * FROM locations";
$pdoStatement = $pdo->query($getAllLocationsSql);
$resList = $pdoStatement->fetchAll();

//print_r($resList);

foreach ($resList as $key => $value){
	echo "<a href='?id=" . $value['loc_id'] . "'>";
	echo $value['loc_name'].'&nbsp';
	echo $value['loc_adr'].'&nbsp';
	echo $value['loctype_typ_id'].'&nbsp';
	echo $value['loc_cp'].'&nbsp';
	echo $value['loc_city'].'&nbsp';
	echo $value['loc_desc'].'&nbsp';
	echo '<img id="adm_loc_img" src="data:image/jpeg;base64,'.base64_encode($value['loc_img']).'"/>'.'&nbsp';
	echo '<br>--------------------------------<br>';
}

include 'add_location.php';

echo "";
//when selected auto fill in a form where you can change the role

?>
</pre>