<?php

/*
EXERCICE 1
- modifier le POST d'inscription pour vérifier
	la validité de l'adresse email
- modifier le POST d'inscription pour qu'un user
	soit unique (basé sur email)
EXERCICE++
- ajouter la contrainte d'unicité de
	l'email dans la table user
- modifier le POST d'inscription pour vérifier
	que le password soit assez complexe : taille >= 8
EXERCICE-extra
- modifier le POST d'inscription pour vérifier
	que le password soit complexe :
		taille >= 8, au moins un chiffre
		et une majuscule (passer par une expression régulière)
*/

/*
EXERCICE 2
- à partir du formulaire fourni, ajouter une ligne
	dans le tableau $_SESSION avec clé et valeur
- afficher le contenu du tableau $_SESSION (sans print_r)
- afficher l'identifiant de session (voir la doc)
EXERCICE++
- permettre à l'utilisateur de supprimer une ligne
	du tableau $_SESSION (qu'il choisit, passer la clé en GET par exemple)
*/
?>
<form action="" method="post">
	<fieldset>
		<legend>Play with PHP Session</legend>
		<input type="text" name="key" value="" placeholder="Clé tableau session" /><br />
		<input type="text" name="value" value="" placeholder="Valeur tableau session" /><br />
		<input type="submit" value="Add to $_SESSION" />
	</fieldset>
</form>
<?php


/*
EXERCICE 3
- modifier le script de login pour mettre
	en session login et password crypté
- modifier le script de sign up pour mettre
	en session login et password crypté
EXERCICE-extra
- passer dans une fonction la vérification email password
- ne pas afficher le form inscription si déjà connecté
- ne pas afficher le form login si déjà connecté
- ajouter un bouton "deconnexion" si déjà connecté,
	qui va déconnecter (supprimer les variables en session)
*/