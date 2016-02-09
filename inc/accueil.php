<?php require 'header.php'; ?>
<pre>
<?php
 
require 'config.php';
//SQL REQUEST
$getLocations="
	SELECT *
	FROM locations
";
$pdoStatement=$pdo->prepare($getLocations);
//EXECUTE IT
$pdoStatement->execute();
$results=$pdoStatement->fetchAll();
//LOOP TO DISPLAY DATA
foreach ($results as $key => $loc_data) {
	echo '<br/>';
	echo $loc_data['loc_name'].'<br/>';
	if ($loc_data['loctype_typ_id']==0) {
		echo 'Restaurant<br/>';
	} else if ($loc_data['loctype_typ_id']==1) {
		echo '<br/>';
	} else if ($loc_data['loctype_typ_id']==2) {
		echo '<br/>';
	}
	echo $loc_data['loc_adr'].'<br/>';
	echo $loc_data['loc_cp'].'<br/>';
	echo $loc_data['loc_city'].'<br/>';
	echo $loc_data['loc_desc'].'<br/>';
}
?>
</pre>
<?php require 'footer.php'; ?>