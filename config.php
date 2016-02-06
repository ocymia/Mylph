<?php
// Connexion à la DB
$dsn = 'mysql:host=localhost;dbname=mylph;charset=UTF8';
$user = 'root';
$password = 'YourPW';
//Je vais tenter de faire ignorer config.php par git...

// Effectuer la connexion
$pdo = new PDO($dsn, $user, $password);






?>