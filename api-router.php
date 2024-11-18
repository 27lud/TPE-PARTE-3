<?php
require_once 'libs/router.php';
require_once 'config.php';

require_once 'app/controllers/bikes.api.controller.php';
require_once 'app/controllers/user.api.controller.php';

$router = new Router();

//tabla
$router->addRoute('bikes', 'GET', 'BikesApiController', 'getFilteredBikes');
$router->addRoute('bikes/:ID', 'GET', 'BikesApiController', 'getBike');
$router->addRoute('bikes/:ID', 'DELETE', 'BikesApiController', 'deleteBike');
$router->addRoute('bikes', 'POST', 'BikesApiController', 'insertBike');
$router->addRoute('bikes/:ID', 'PUT', 'BikesApiController', 'updateBike');

$router->addRoute('user/token', 'GET', 'UserApiController', 'getToken');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);