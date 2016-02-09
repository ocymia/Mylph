<?php


//Max
function user_verif($emailLogin,$passwordLogin){
	GLOBAL $pdo;
	$checkUser="
		SELECT *
		FROM users
		WHERE usr_email = :userEmail
	";
	$pdoStatement = $pdo->prepare($checkUser);
	$pdoStatement->bindValue(':userEmail',$emailLogin,PDO::PARAM_STR);
	if ($pdoStatement->execute()) {
		if ($pdoStatement->rowCount()>0) {
			//GET HASHED PWD
			$res=$pdoStatement->fetch();
			$passwordHashed=$res['usr_pwd'];
			//PWD CHECK
			if (password_verify($passwordLogin,$passwordHashed)) {
				$_SESSION['login']=$emailLogin;
				$_SESSION['pwd']=$passwordHashed;
				return true;
			} else {
				echo 'Wrong password.<br/>';
			}
		} else {
			echo 'Sign in failed<br/>';
		}
	} else {
		echo 'Query failed<br/>';
	}
}

function add_location() {
	//sql to add a location
	$add_loc_sql ="";
	

}




// Brice On lui donne une adresse + ou - vague, il nous rend des données en json
// la function renvoie l'adresse telle que google l'a interpretée en [0] du tableau
// en [1] la longitude et en [2] la lattitude
function geocode($address){
	$address = str_replace(" ", "+", $address);
	$geoloc = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&sensor=false"));
	$coord[0] = $geoloc->results[0]->formatted_address;
	$coord[1] = $geoloc->results[0]->geometry->location->lat;
	$coord[2] = $geoloc->results[0]->geometry->location->lng;
	return $coord;
}


// fonction qui crée une map pour point unique, on utilise ici google maps js api
//  recoit latitude & longitude et centre la carte en ajoutant un pin sur le point voulu, avec pour troisieme argument le nom
function map_unique($lat,$lng,$name){
	?>
    <div id="map_unique"></div>
    <script>
    var myLatLng = {lat: <?php echo $lat . ", lng: " . $lng; ?> };
      var map;
      var marker;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map_unique'), {
          center: myLatLng,
          zoom: 12
        });
        marker = new google.maps.Marker({
	    position: myLatLng,
    	map: map,
    	title: '<?php echo $name; ?>'
  });
      }
    </script>
    <!-- Ici on utilise une key associée à mon compte google, on a de la marge meme en gratuit -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTHaHNjsn7D8rJRnaiLC_s9OhgdNEh9sk&callback=initMap"
    async defer></script>
	<?php
}





?>