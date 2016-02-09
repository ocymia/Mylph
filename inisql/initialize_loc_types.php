<?php
//initialize db location types
//conenction details for db // contains $pdo



$rowcount_types = "SELECT * FROM loctype";
$pdoCount = $pdo->query($rowcount_types);


if ($pdoCount->rowCount() == 0){
	//create types
	$sqltypes="
		INSERT INTO loctype (typ_id,typ_name)
		VALUES (1,'Restaurant'),(2,'Entertainment'),(3,'Accessibility'),(4,'Other')
	";
	$pdoStatement = $pdo->query($sqltypes);
} else {
	//do nothin - types seem to exist already
}


?>
