<?php require('inc/header.php'); ?>

<html>
<head>
<title>&Eacute;tapes du projet en &eacute;quipe</title>
</head>
<body>
	<?php
		if (!empty($_SESSION)) {
			header('Location: inc/accueil.php');
		} else if ($_SESSION['usr_role']==2) {
			header('Location: index_of_jerry.php');
		} else {
			header('Location: inc/login.php');
		}
	?>
</body>
</html>



<?php require('footer.php'); ?>

