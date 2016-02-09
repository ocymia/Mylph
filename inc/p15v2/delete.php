<?php
require 'maghnia_la_star.php';

// JE supprime une donnée de la session
unset($_SESSION['tata']);

// Suppression de la session
if (isset($_GET['all'])) {
	session_destroy();
}
?>
<a href="sessions.php">retour</a>