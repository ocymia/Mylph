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
	$thisLocation = $pdoStatement -> fetch();
	//print_r($thisLocation);//exit;

echo '<h2>Name : </h2>';
echo $thisLocation['loc_name'].'<br>';

echo '<h2>Category : </h2>';
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

echo '<h2>Address : </h2>';
echo $thisLocation['loc_adr'].'<br>';
echo $thisLocation['loc_cp'].'&nbsp';
echo $thisLocation['loc_city'].'<br>'.'<br>';
echo '<h2>Description : </h2>';
echo $thisLocation['loc_desc'].'<br>';
echo '<h2>Map : </h2><br>';
echo $thisLocation['loc_img'].'image space<br>';
}

?>
<form action="" method="post">
	<input type="submit" value="like"/>
</form>


<?php require 'footer.php'; ?>