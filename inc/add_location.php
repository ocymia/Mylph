<?php
//conenction details for db // contains $pdo
require 'config.php';
//function to add location (add_location())
require 'functions.php';

//if the form is submitted == if there are post variables
if (!empty($_POST)) {
	print_r($_POST); // pour debug
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
	
	//$loc_x ; //auto via google api?!
	//$loc_y ; //auto via google api?!

	//sql for adding location
	$add_loc_sql ="
		INSERT INTO locations (loc_name,loc_adr ,loc_city ,loc_cp ,loc_desc ,loc_img ,loctype_typ_id)
		VALUES (:name,:adr ,:city ,:cp ,:desc ,:img ,:typ_id)
	";

	// Inserting into db
	$pdoStatement = $pdo->prepare($add_loc_sql);
	// Je bind toutes les variables de requête
	$pdoStatement->bindValue(':name', $loc_name);
	$pdoStatement->bindValue(':adr', $loc_adr);
	$pdoStatement->bindValue(':city', $loc_city);
	$pdoStatement->bindValue(':cp', $loc_cp);
	$pdoStatement->bindValue(':desc', $loc_desc);
	$pdoStatement->bindValue(':img', $loc_img);
	$pdoStatement->bindValue(':typ_id', $loctype_typ_id);

	$pdoStatement->execute();

}//end (!empty($_POST))



// db fields are: loctype_typ_id ; loc_adr ; loc_city ; loc_cp
//			loc_desc ; loc_id ; loc_img ; loc_name ; loc_x ; loc_y
?>
<form action="" method="post">
	<legend>Add location</legend>
	<fieldset>
		<table>
			<tr>
				<td>Nom :&nbsp;</td>
				<td><input type="text" name="loc_name" value=""/></td>
			</tr>
			<tr>
				<td>Adr :&nbsp;</td>
				<td><input type="text" name="loc_adr" value=""/></td>
			</tr>
			<tr>
				<td>City :&nbsp;</td>
				<td><input type="text" name="loc_city" value=""/></td>
			</tr>
			<tr>
				<td>Code Postal :&nbsp;</td>
				<td><input type="text" name="loc_cp" value=""/></td>
			</tr>
			<tr>
				<td>Description :&nbsp;</td>
				<td><input type="text" name="loc_desc" value=""/></td>
			</tr>
			<tr>
				<td>Type :&nbsp;</td>
				<td><input type="radio" name="loctype_typ_id" value="1"/>Restaurant</td>
				<td><input type="radio" name="loctype_typ_id" value="2"/>Entertainment</td>
				<td><input type="radio" name="loctype_typ_id" value="3"/>Accessibility</td>
				<td><input type="radio" name="loctype_typ_id" value="4"/>Other</td>
			</tr>
			<td><input type="submit" value="add location"/></td>
		</table>
	</fieldset>
</form>	