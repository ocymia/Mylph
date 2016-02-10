<?php 
require 'header.php';
//require 'config.php'; 
session_start();

print_r($_SESSION);
//get the get from url sent by acceuil...
?>



<pre>

<?php 
$ratingExists=0;
echo "<br><br>IIIIIIIIIIIIINIIIIIIII This runs , ".$ratingExists."<br>";
if (!empty($_GET['loc'])) {
//if (!empty($_GET)) {
	//do all the stuff to display the desired locations details
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
	map_unique($thisLocation['loc_x'],$thisLocation['loc_y'],$thisLocation['loc_name']);
	//echo $thisLocation['loc_img'].'image space<br>';
	echo '<img id="adm_loc_img" src="data:image/jpeg;base64,'.base64_encode($thisLocation['loc_img']).'"/>';

	echo '<br><br><br>';
	echo '<h3>G1v3 R@t1ng</h3><br>';
	//get current rating if exists
	echo  "id????".$_SESSION['user_id'];
	$currentSissi = $_SESSION['user_id'];//id!
	$currentLoc = $_GET['loc'];
	//I am assuming that there is a session id in place since there is no way to get to this page without loging in
	$getRating="SELECT vote_rating FROM vote WHERE locations_loc_id=".$currentLoc." AND users_usr_id=".$currentSissi;
	$pdoStatement=$pdo->query($getRating);
	if ($pdoStatement->rowCount()>0) {
		echo 'rating exists';
//$ratingExists=1;//commented for debug
	}
	echo 'pdoStatement';
	print_r($pdoStatement);
	$thisRating = $pdoStatement -> fetch();
	echo 'thisRating';
	print_r($thisRating);
}// end if (!empty($_GET))

if (!empty($_GET['rate'])&&!empty($_GET['loc'])&&!empty($_SESSION['user_id'])) {
	echo "<br><br>OOOOOOOOOOO This runs , ".$ratingExists."<br>";
	if ($ratingExists==0){
		echo "<br><br>ZZZZZZZZZZZZZZZ This runs , ".$ratingExists."<br>";
		$setRating=
		"INSERT INTO vote (locations_loc_id,users_usr_id,vote_rating)
		VALUES (".$_GET['loc'].",".$_SESSION['user_id'].",".$_GET['rate'].")";
		$pdoRating=$pdo->query($setRating);
		$ratingExists=1;
		header ('Location: http://127.0.0.1/mylph/inc/detailrescued.php?loc='.$_GET['loc']);
		echo "<br><br>XXXXXXX This runs , ".$ratingExists."<br>";
		exit;
	} else if ($ratingExists==1){
		//update instead
		echo "<br><br>EEELLLSSSEEEE  This runs , ".$ratingExists."<br>";
		}
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

// on vérifie si l'utilisateur a déjà liké
$sql = "SELECT COUNT(*) AS voted FROM vote WHERE users_usr_id = $currentSissi AND locations_loc_id = :id";
$pdoStatement = $pdo->prepare($sql);
$pdoStatement->bindValue(':id', $_GET['loc']);
$pdoStatement->execute();
$resList = $pdoStatement->fetch();
$voted = $resList['voted'];
// on récolte le nombre de likes
$sql = "SELECT COUNT(*) AS likes FROM vote WHERE locations_loc_id = :id";
$pdoStatement = $pdo->prepare($sql);
$pdoStatement->bindValue(':id', $_GET['loc']);
$pdoStatement->execute();
$resList = $pdoStatement->fetch();
$likes = $resList['likes'];
echo $voted;
?>
<form action="" method="post">
	<input type="submit" value="<?php 
		if($voted == 0){
			echo "Like! (" . $likes . ")";
		}else{
			echo "(".$likes." likes)";
		}?>
		"/>
	<input type="hidden" name="like" value="<?php echo $liked; ?>">
</form>
<?php

// en cas de like, si on a pas deja liké, on passe la valeur de vote à 1
if(isset($_POST['like']) && $voted == 0){
	echo $currentSissi . " " . $_GET['loc'];
	$sql = "INSERT INTO vote (users_usr_id, locations_loc_id, vote_like)
			VALUES (:id,:loc_id,1)";
			echo $sql;
	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->bindValue(':id', $currentSissi);
	$pdoStatement->bindValue(':loc_id', $_GET['loc']);
	$pdoStatement->execute();
	echo $currentSissi . " " . $_GET['loc'];
}



require 'footer.php'; ?>