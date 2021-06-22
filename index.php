<?php

require './altorouter/AltoRouter.php';

$router = new AltoRouter();

$router->setBasePath($_SERVER['BASE_URI']);

$router->map('GET', '/', function() {
    echo "Musicoshop API";
});

/**
 * article
 */
$router->map('GET', '/article', function() {
    require __DIR__ . '/api/article/read.php';
});

$router->map('GET', '/article/[i:Id_Article]', function($Id_Article) {
    require __DIR__ . '/api/article/singleRead.php';
});


/**
 * categorie
 */
$router->map('GET', '/categorie', function() {
    require __DIR__ . '/api/categorie/read.php';
});

$router->map('GET', '/categorie/[i:idCategorie]', function($idCategorie) {
    require __DIR__ . '/api/categorie/singleRead.php';
});

/*$router->map('POST', '/categorie/update', function() {
    require __DIR__ . '/api/vol/update.php';
});

$router->map('POST', '/vol/delete', function() {
    require __DIR__ . '/api/vol/delete.php';
});*/

/**
 * commande
 */
$router->map('GET', '/commande', function() {
    require __DIR__ . '/api/commande/read.php';
});

$router->map('GET', '/commande/[i:idCmd]', function($idCmd) {
    require __DIR__ . '/api/commande/singleRead.php';
});


/**
 * instruments
 */
$router->map('GET', '/instruments', function() {
    require __DIR__ . '/api/instruments/read.php';
});

$router->map('GET', '/instruments/[i:Id_Instrument]', function($Id_Instrument) {
    require __DIR__ . '/api/instruments/singleRead.php';
});


/**
 * ligne_commande
 */
$router->map('GET', '/ligne_commande', function() {
    require __DIR__ . '/api/ligne_commande/read.php';
});

$router->map('GET', '/ligneCommande/[a:idLigneCmd]', function($idLigneCmd) {
    require __DIR__ . '/api/ligne_commande/singleRead.php';
});


/**
 * panier
 */
$router->map('GET', '/panier', function() {
    require __DIR__ . '/api/panier/read.php';
});

$router->map('GET', '/panier/[a:Id_Panier]', function($Id_Panier) {
    require __DIR__ . '/api/panier/singleRead.php';
});


/**
 * utilisateur
 */
$router->map('GET', '/utilisateur', function() {
    require __DIR__ . '/api/utilisateur/read.php';
});

$router->map('GET', '/utilisateur/[i:IdUtilisateur]', function($IdUtilisateur) {
    require __DIR__ . '/api/utilisateur/singleRead.php';
});

$router->map('POST', '/utilisateur/login', function($IdUtilisateur) {
    require __DIR__ . '/api/utilisateur/login.php';
});

$match = $router->match();

if($match) {
	$match['target']($match['params']);
} else {
	header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}