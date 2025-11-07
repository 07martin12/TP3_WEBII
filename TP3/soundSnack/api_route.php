<?php
require_once './libs/router/router.php';
require_once './app/controllers/ArtistaController.php';
require_once './app/controllers/CancionController.php';

$router = new Router();

$router->addRoute('artistas', 'GET', 'ArtistaController', 'getAll');
$router->addRoute('artista/:id', 'GET', 'ArtistaController', 'getById');

$router->addRoute('canciones/:id_artista', 'GET', 'CancionController', 'getByArtista');
$router->addRoute('cancion/:id_artista/:id_cancion', 'GET', 'CancionController', 'getById');

$router->setDefaultRoute('ArtistaController', 'notFound');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
