<?php
//maybe check if session  var role is the admin? (==2)
require 'config.php';
require 'functions.php';

//show list of users
$getAllUsersSql "SELECT * FROM users";
$pdoStatement = $pdo->query($getAllUsersSql);
$resList = $pdoStatement->fetchAll();

print_r($resList);


//when selected auto fill in a form where you can change the role


?>