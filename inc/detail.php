<?php 
require 'header.php';
//require 'config.php'; 
session_start();
//get the get from url sent by acceuil...
?>



<pre>

<?php 
if (!empty($_GET['loc'])) {
	//do all the stuff to display the desired locations details
	$thisId = $_GET['loc'];
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
	echo '<br><br><br>';
	echo '<h3>G1v3 R@t1ng</h3><br>';
	//get current rating if exists
	$currentSissi = $_SESSION['user_id'];//id!
	$currentLoc = $_GET['loc'];
	//there shouldd be a session id in place since this is only accessible after loging in
	$getRating="SELECT vote_rating FROM vote WHERE locations_loc_id=".$currentLoc." AND users_usr_id=".$currentSissi;
//if rating != 0 then update instead
	$pdoStatement=$pdo->query($getRating);
	if ()
	echo 'pdoStatement';
	print_r($pdoStatement);
	$thisRating = $pdoStatement -> fetch();
	echo 'thisRating';
	print_r($thisRating);
} // end if (!empty($_GET))


if (!empty($_GET['rate'])&&!empty($_GET['loc'])&&!empty($_SESSION['user_id'])) {
	$setRating=
	"INSERT INTO vote (locations_loc_id,users_usr_id,vote_rating)
	VALUES (".$_GET['loc'].",".$_SESSION['user_id'].",".$_GET['rate'].")";
	$pdoRating=$pdo->query($setRating);
	header ('Location: http://127.0.0.1/mylph/inc/detail.php?loc='.$_GET['loc']);
	exit;
}


//this var will put a get var that lauches an sql entry for the current user
$starNbr=0;
//full stars

echo 'the suspects: '.$thisRating['vote_rating'].' '.$currentLoc.' '.$starNbr;

for ($i=0;$i<$thisRating['vote_rating'];$i++){
	$starNbr++;
	echo '<a href="?loc='.$currentLoc.'&rate='.$starNbr.'"><img class="star" src="../img/rated.gif"/></a>';
	}
//empty stars
for ($i=$thisRating['vote_rating'];$i<5;$i++){

	$starNbr++;
	echo '<a href="?loc='.$currentLoc.'&rate='.$starNbr.'"><img class="star" src="../img/notrated.gif"/></a>';
	}	

?>
<form action="" method="post">
	<input type="submit" value="like"/>
</form>


<?php require 'footer.php'; ?>