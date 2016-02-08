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
foreach ($results as $key => $value) { ?>
	<div>
		<?php
			echo $value['loc_name'].'<br/>';
			echo $value['loc_adr'].'<br/>';
			echo $value['loc_cp'].'<br/>';
			echo $value['loc_city'].'<br/>';
			echo $value['loc_desc'].'<br/>';
		?>
	</div>
<?php }
?>
</pre>
<?php require 'footer.php'; ?>