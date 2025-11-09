<?php
require_once './libs/router/router.php';
require_once './libs/jwt/JwtMiddleware.php';
require_once './app/middlewares/GuardMiddleware.php';
require_once './app/controllers/ArtistaController.php';
require_once './app/controllers/CancionController.php';
require_once './app/controllers/AuthApiController.php';

$router = new Router();

$router->addRoute('auth/login', 'POST', 'AuthApiController', 'login');

$router->addRoute('artistas', 'GET', 'ArtistaController', 'getAllArtista');
$router->addRoute('artista/:id', 'GET', 'ArtistaController', 'getByIdArtista');

$router->addRoute('canciones/:id_artista', 'GET', 'CancionController', 'getByArtista');
$router->addRoute('cancion/:id_cancion', 'GET', 'CancionController', 'getById');

$router->addMiddleware(new JWTMiddleware());
$router->addMiddleware(new GuardMiddleware());

$router->addRoute('artistas', 'POST', 'ArtistaController', 'addArtista');
$router->addRoute('artista/:id', 'PUT', 'ArtistaController', 'updateArtista');
$router->addRoute('artista/:id', 'DELETE', 'ArtistaController', 'deleteArtista');

$router->addRoute('canciones/:id_artista', 'POST', 'CancionController', 'insert');
$router->addRoute('cancion/:id_cancion', 'PUT', 'CancionController', 'update');
$router->addRoute('cancion/:id_cancion', 'DELETE', 'CancionController', 'delete');

$router->setDefaultRoute('ArtistaController', 'notFoundArtista');
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
