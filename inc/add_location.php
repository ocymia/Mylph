<?php
//require 'header.php';

//if the form is submitted == if there are post variables
if (!empty($_POST)) {
	print_r($_POST); // pour debug
	print_r($_FILES); //for debug too
	// Récupération et traitement des variables du formulaire d'ajout/modification
	
	//loc_id ; //auto incremented at creation?!
	$loc_name = isset($_POST['loc_name']) ? trim($_POST['loc_name']) : ''; 
	$loc_adr = isset($_POST['loc_adr']) ? trim($_POST['loc_adr']) : ''; 
	$loc_city = isset($_POST['loc_city']) ? trim($_POST['loc_city']) : ''; 
	$loc_cp= isset($_POST['loc_cp']) ? intval(trim($_POST['loc_cp'])) : 0;
	$loc_desc = isset($_POST['loc_desc']) ? trim($_POST['loc_desc']) : ''; 
	//$loc_img est probablemnt a changer vu qu'on va devoir importer un fichier blob...
	$loc_img = isset($_POST['loc_img']) ? trim($_POST['loc_img']) : ''; 
	$loctype_typ_id = isset($_POST['loctype_typ_id']) ? intval(trim($_POST['loctype_typ_id'])) : 0; 
	// coordonnées latitude & longitude
	$locXY = geocode($_POST['loc_adr'] . "," . $_POST['loc_city']);

	//for uploading image
	if (count($_FILES)>0) {
		$loc_img = file_get_contents($_FILES['loc_img']['tmp_name']);
	}
	//sql for adding location
	if(!isset($_GET['id'])){
	$add_loc_sql ="
		INSERT INTO locations (loc_name,loc_adr ,loc_city ,loc_cp ,loc_desc ,loc_img ,loctype_typ_id, loc_x, loc_y)
		VALUES (:name,:adr ,:city ,:cp ,:desc ,:img ,:typ_id ,:loc_x ,:loc_y)
		";
			$pdoStatement = $pdo->prepare($add_loc_sql);
			// Je bind toutes les variables de requête
			$pdoStatement->bindValue(':name', $loc_name);
			$pdoStatement->bindValue(':adr', $loc_adr);
			$pdoStatement->bindValue(':city', $loc_city);
			$pdoStatement->bindValue(':cp', $loc_cp);
			$pdoStatement->bindValue(':desc', $loc_desc);
			$pdoStatement->bindValue(':img', $loc_img);
			$pdoStatement->bindValue(':typ_id', $loctype_typ_id);
			$pdoStatement->bindValue(':loc_x', $locXY['1']);
			$pdoStatement->bindValue(':loc_y', $locXY['2']);

	} else {
	// sql if modification
		$add_loc_sql ="
		UPDATE locations SET (loc_name,loc_adr ,loc_city ,loc_cp ,loc_desc ,loctype_typ_id)
		VALUES (:name,:adr ,:city ,:cp ,:desc ,:typ_id) WHERE loc_id = :id
		";
		echo $add_loc_sql;
			$pdoStatement = $pdo->prepare($add_loc_sql);
			// Je bind toutes les variables de requête
			$pdoStatement->bindValue(':name', $loc_name);
			$pdoStatement->bindValue(':adr', $loc_adr);
			$pdoStatement->bindValue(':city', $loc_city);
			$pdoStatement->bindValue(':cp', $loc_cp);
			$pdoStatement->bindValue(':desc', $loc_desc);
			$pdoStatement->bindValue(':typ_id', $loctype_typ_id);
			$pdoStatement->bindValue(':id', $_GET['id']);
	}

	// insertion ou modification dans mysql
	$pdoStatement->execute();

}//end (!empty($_POST))


// on fetch les infos pour modifier, si on nous a donné un ID
if(!empty($_GET['id'])){
	$sql = "SELECT loc_name, loc_adr, loc_city, loc_cp, loc_desc, loctype_typ_id FROM locations WHERE loc_id = :id";
	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->bindValue(':id', $_GET['id']);
	$pdoStatement->execute();
	$resList = $pdoStatement->fetch();
}


// db fields are: loctype_typ_id ; loc_adr ; loc_city ; loc_cp
//			loc_desc ; loc_id ; loc_img ; loc_name ; loc_x ; loc_y
?>
<form action="" method="post" enctype="multipart/form-data">
	<legend>Add location</legend>
	<fieldset>
		<table>
			<tr>
				<td>Nom :&nbsp;</td>
				<td><input type="text" name="loc_name" value="<?php echo @$resList['loc_name']; ?>"/></td>
			</tr>
			<tr>
				<td>Adr :&nbsp;</td>
				<td><input type="text" name="loc_adr" value="<?php echo @$resList['loc_adr']; ?>"/></td>
			</tr>
			<tr>
				<td>City :&nbsp;</td>
				<td><input type="text" name="loc_city" value="<?php echo @$resList['loc_city']; ?>"/></td>
			</tr>
			<tr>
				<td>Code Postal :&nbsp;</td>
				<td><input type="text" name="loc_cp" value="<?php echo @$resList['loc_cp']; ?>"/></td>
			</tr>
			<tr>
				<td>Description :&nbsp;</td>
				<td><input type="text" name="loc_desc" value="<?php echo @$resList['loc_desc']; ?>"/></td>
			</tr>
			<tr>
				<td>Type :&nbsp;</td>
				<td>
				<input type="radio" name="loctype_typ_id" value="1" <?php if(@$resList['loctype_typ_id'] == 1) echo "checked"; ?>/>Restaurant
				<input type="radio" name="loctype_typ_id" value="2" <?php if(@$resList['loctype_typ_id'] == 2) echo "checked"; ?>/>Entertainment
				<input type="radio" name="loctype_typ_id" value="3" <?php if(@$resList['loctype_typ_id'] == 3) echo "checked"; ?>/>Accessibility
				<input type="radio" name="loctype_typ_id" value="4" <?php if(@$resList['loctype_typ_id'] == 4) echo "checked"; ?>/>Other</td>
			</tr>
			<tr>
				<td><input type="file" name="loc_img" /></td>
			</tr>
			<tr>
				<td><input type="submit" value="add location"/></td>
			</tr>
		</table>
	</fieldset>
</form>	