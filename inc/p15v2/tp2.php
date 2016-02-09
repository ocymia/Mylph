<?php
session_start();
?>
<html>
<head>
	<title>PHP Session Game</title>
</head>
<body>
<pre><?php
// Formulaire soumis
if (!empty($_POST)) {
	// Je récupère les variables
	$key = isset($_POST['key']) ? trim($_POST['key']) : '';
	$value = isset($_POST['value']) ? trim($_POST['value']) : '';

	// Je vérifie les données
	if (!empty($key) && !empty($value)) {
		// J'ajoute les données en session
		$_SESSION[$key] = $value;
	}
}
// Si suppression soumise en GET
if (!empty($_GET['delete'])) {
	if (isset($_SESSION[$_GET['delete']])) {
		// Je supprime la donnée de session
		unset($_SESSION[$_GET['delete']]);
	}
}

?></pre>
<form action="" method="post">
	<fieldset>
		<legend>Play with PHP Session</legend>
		<input type="text" name="key" value="" placeholder="Clé tableau session" /><br />
		<input type="text" name="value" value="" placeholder="Valeur tableau session" /><br />
		<input type="submit" value="Add to $_SESSION" />
	</fieldset>
</form>

<?php

// J'affiche les données en SESSION
echo '<h3>$_SESSION</h3>';
echo 'ID='.session_id().'<br /><br />';
foreach ($_SESSION as $key => $value) {
	echo $key.' => '.$value.' <a href="tp2.php?delete='.$key.'">&gt delete</a><br />';
}

?>
</body>
</html>