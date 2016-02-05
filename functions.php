<?php

// fonction qui utilise l'API geocode de google, recoit une addresse et renvoie un tableau contenant l'adresse formattée, la laitude et la longitude
function geocode($address){
	$address = str_replace(" ", "+", $address);
	$geoloc = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&sensor=false"));
	$coord[0] = $geoloc->results[0]->formatted_address;
	$coord[1] = $geoloc->results[0]->geometry->location->lat;
	$coord[2] = $geoloc->results[0]->geometry->location->lng;
	return $coord;
}

// test de la fonction
print_r(geocode("12 rue du cimetière, fouches, belgique"));



?>
