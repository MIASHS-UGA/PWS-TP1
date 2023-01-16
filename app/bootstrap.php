<?php

/**
 * TOUT LE CODE CONTENU DANS LES BALISES <?php et ?>
 * SERA EXECUTÉ COTÉ SERVEUR
 * ET NE SERA PAS VISIBLE DANS LE NAVIGATEUR HTML
 */

session_start(); //inititialise la session. Permet de créer un lien avec chaque visiteur et de stocker des informations dans $_SESSION

//Variables

//Une constante pour spécifier l'url du site
//utilisée pour les liens hypertextes, les feuilles de style, les fichiers Javascript, les images, etc.
define('BASE_URL', '/'); //à utiliser si vous utilisez la commande "php -S localhost:2023" pour accéder au projet
// define('BASE_URL','/PWS-TP1/'); //à utiliser si vous utiliser une stack WAMP/LAMP/MAMP et que vous accédez au projet avec une url du type http://localhost/PWS-TP1/

DEFINE('DB_PATH', realpath("./database.sqlite") );

// Session

//Si le paramètre ajoutSession est présent dans l'URL, on ajoute une valeur aléatoire dans la session
//Ces valeurs seront conservées pour l'utilisateur tant que la session sera valide ou non détruite
if (isset($_GET['ajoutSession'])) {
  $_SESSION['variables_session'][] = rand();
}
//Si le paramètre detruireSession est présent dans l'URL, on détruit la session et on en initialise une nouvelle
if (isset($_GET['detruireSession'])) {
  session_destroy();
  session_start();
}

?>