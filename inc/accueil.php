<?php
require 'header.php';
include_once '../inisql/initialize_loc_types.php';
include_once '../inisql/initialize_roles.php';

// Display da multiple map, dans la div #multiple_map
echo '<div id=mapA>';
map_multiple();
echo '</div>';
// si on est admin, on affiche les liens d'admin dans la div #menu_admin
if(isset($_SESSION['usr_role']) && $_SESSION['usr_role'] == 2){
	?>
	<div id="menu_admin">
		<ul>
			<li><a href="admin_locations.php">admin_locations.php</a></li>
			<li><a href="admin_users.php">admin_users.php</a></li>
		</ul>
	</div>
	<?php
}

//SQL REQUEST For Locations
$getLocations="
	SELECT *
	FROM locations
	LIMIT 10
";
$pdoStatement=$pdo->prepare($getLocations);
//EXECUTE IT
$pdoStatement->execute();
$results=$pdoStatement->fetchAll();



?>
<div id="main">
	<?php

	//LOOP TO DISPLAY DATA dans la class #location
	foreach ($results as $key => $loc_data) {
		?>
		<div class="location">
		<?php
			//AVG Rating
			$currentLocationID = $loc_data['loc_id'];
			$avgSql = "SELECT AVG(vote_rating) FROM vote WHERE locations_loc_id=".$currentLocationID;
			$avgRating=$pdo->query($avgSql);
			$thisRating = $avgRating -> fetch();
			//Total Likes
			$likesSql = "SELECT vote_like FROM likes WHERE locations_loc_id=".$currentLocationID;
			$avgLikes=$pdo->query($likesSql);
			$thisLikes = $avgLikes->rowCount();
			
						

			//the rest
			echo '<div class="div_accueil">';
			echo '<br/>';
			echo '<p class="loc_name"><h2><b>Name:</b> ' . $loc_data['loc_name'].'</h2></p>';
			?><p class="loctype_typ_id"><b>Type:</b> <?php

				// chaque ligne a une CLASS pour le front, par facilité avec la dénomination utilisée dans MySQL
				if ($loc_data['loctype_typ_id']==1) {
					echo 'Restaurant<br/>';
				} else if ($loc_data['loctype_typ_id']==2) {
					echo 'Entertainment<br/>';
				} else if ($loc_data['loctype_typ_id']==3) {
					echo 'Accessibility<br/>';
				} else if ($loc_data['loctype_typ_id']==4) {
					echo 'Other<br/>';
				}
			?></p><?php
			echo "<p class='loc_adr'><b>Adr:</b> " . $loc_data['loc_adr'] . '</p>';
			echo "<p class='loc_cp'>L-" . $loc_data['loc_cp'];
			echo ' '.$loc_data['loc_city'] . '</p>';
			echo "<p class='loc_desc'><b>Description:</b> " . $loc_data['loc_desc'] . '</p>';
			//detail button that posts get and sends to detail.php with that get
			echo '<form action="detail.php?loc='.$loc_data['loc_id'].'" method="post">';
			//echo '<input type="hidden" name="l_id" value="'.$value['usr_id'].'"/>';
			//next line seems weird, but in fact it adds the image. really, trust me!
			echo '<img class="adm_loc_img" src="data:image/jpeg;base64,'.base64_encode($loc_data['loc_img']).'"/><br /><br />';
			echo 'Rating : '.round($thisRating ['AVG(vote_rating)'])."/5 & a total of ".$thisLikes." Likes!<br>";
			echo '<input type="submit" value="details"/>';
			echo '</form>';
			echo '</div>';
			?>
		</div>
		<?php
	}
	?>
</div>
<?php require 'footer.php'; ?>