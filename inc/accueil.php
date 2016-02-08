<pre>
<?php
 
require 'config.php';

$getLocations="
	SELECT *
	FROM locations
";
$pdoStatement=$pdo->prepare($getLocations);
$pdoStatement->execute();
$result=$pdoStatement->fetchAll();
print_r($result);
?>
</pre>