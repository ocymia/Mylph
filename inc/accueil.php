<?php require 'header.php'; ?>
<pre>
<?php
 
require 'config.php';

$getLocations="
	SELECT *
	FROM locations
";
$pdoStatement=$pdo->prepare($getLocations);
$pdoStatement->execute();
$results=$pdoStatement->fetchAll();
//print_r($results);
foreach ($results as $key => $value) {
	echo 'NEW LOC:<br/>';
	echo 'Name of location: '.$value['loc_name'].'<br/>';
	echo 'Address of location: '.$value['loc_adr'].'<br/>';
	echo 'Postal code: '.$value['loc_cp'].'<br/>';
	echo 'City: '.$value['loc_city'].'<br/>';
	echo 'Description: '.$value['loc_desc'].'<br/>';
	echo 'IMAGE: '.$value['loc_img'].'<br/>';
	echo 'x?: '.$value['loc_x'].'<br/>';
	echo 'y?: '.$value['loc_y'].'<br/>';
	echo '<br/>';
}
?>
</pre>
<?php require 'footer.php'; ?>