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
	//detail button that posts get and sends to detail.php with that get
	echo '<form action="detail.php?loc='.$loc_data['loc_id'].'" method="post">';
	//echo '<input type="hidden" name="l_id" value="'.$value['usr_id'].'"/>';
	echo '<input type="submit" value="details"/>';
	echo '</form>';

}
?>
</pre>
<?php require 'footer.php'; ?>