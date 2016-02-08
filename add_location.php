<?php
//conenction details for db
require 'inc/config.php';
//function to add location (add_location())
require 'inc/functions.php';

//if the form is submitted == if there are post variables
if (!empty($_POST)) {
	//loc_id ; //auto incremented at creation?!
	loc_name = isset($_POST['loc_name']) ? trim($_POST['loc_name']) : ''; 
	loc_adr = isset($_POST['loc_adr']) ? trim($_POST['loc_adr']) : ''; 
	loc_city = isset($_POST['loc_city']) ? trim($_POST['loc_city']) : ''; 
	loc_cp= isset($_POST['fil_id']) ? intval(trim($_POST['fil_id'])) : 0;
	loc_desc = isset($_POST['loc_desc']) ? trim($_POST['loc_desc']) : ''; 
	//loc_img est probablemnt a changer vu qu'on va devoir importer un fichier blob...
	loc_img = isset($_POST['loc_img']) ? trim($_POST['loc_img']) : ''; 
	loctype_typ_id = isset($_POST['fil_id']) ? intval(trim($_POST['fil_id'])) : 0; 
	//loc_x ; //auto via google api?!
	//loc_y ; //auto via google api?!
}



// db fields are: loctype_typ_id ; loc_adr ; loc_city ; loc_cp
//			loc_desc ; loc_id ; loc_img ; loc_name ; loc_x ; loc_y
?>
<form action="" method="post">
	<legend>Add location
		<table>
			<tr>
				<td>Nom :&nbsp;</td>
				<td><input type="text" name="loc_name" value="<?php echo $fil_titre; ?>"/></td>
			</tr>
		</table>
	</fieldset>
</form>	