<?php require 'header.php';
require 'config.php'; 

//get the get from url sent by acceuil...
?>



<pre>

<?php 
if (!empty($_GET)) {

	$thisId = $_GET['loc'];
	//echo $thisId;
	$getLocation="	SELECT * FROM locations WHERE loc_id = ".$thisId;
	$pdoStatement=$pdo->query($getLocation);
	$thisLocation = $pdoStatement -> fetchAll();
	print_r($thisLocation);exit;
echo $thisLocation['loc_name'].'<br>';

switch ($thisLocation['loctype_typ_id']) {
	case '1':
		echo "Restaurant".'<br>';
		break;
	case '2':
		echo "Entertainment".'<br>';
		break;
	case '3':
		echo "Accessibility".'<br>';
		break;
	case '4':
		echo "Other".'<br>';
		break;
	
	default:
		echo "No Category".'<br>';
		break;
}


echo $thisLocation['loc_adr'].'<br>';
echo $thisLocation['loc_cp'].'<br>';
echo $thisLocation['loc_city'].'<br>'.'<br>';

echo $thisLocation['loc_desc'].'<br>';

echo $thisLocation['loc_img'].'<br>';

}


?>

<?php require 'footer.php'; ?>