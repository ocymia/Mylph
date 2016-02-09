<?php
require 'header.php';
include_once '../inisql/initialize_loc_types.php';
include_once '../inisql/initialize_roles.php';
?>
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
	if ($loc_data['loctype_typ_id']==1) {
		echo 'Restaurant<br/>';
	} else if ($loc_data['loctype_typ_id']==2) {
		echo 'Entertainment<br/>';
	} else if ($loc_data['loctype_typ_id']==3) {
		echo 'Accessibility<br/>';
	} else if ($loc_data['loctype_typ_id']==4) {
		echo 'Other<br/>';
	}
	echo $loc_data['loc_adr'].'<br/>';
	echo $loc_data['loc_cp'].'<br/>';
	echo $loc_data['loc_city'].'<br/>';
	echo $loc_data['loc_desc'].'<br/>';
}
?>
</pre>
<?php require 'footer.php'; ?>