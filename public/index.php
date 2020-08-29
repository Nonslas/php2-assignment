<?php
require '../vendor/autoload.php';

define('APP_PATH', realpath('../app'));
define('WRITABLE_PATH', realpath(APP_PATH.'../writable'));

require APP_PATH . '/common.php';
require APP_PATH . '/database.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
	$r->addRoute('GET', '/', 'Home::index');

	$r->addRoute('GET', '/brands', 'BrandController::index');

	$r->addRoute('GET', '/brands/add', 'BrandController::add_get');
	$r->addRoute('POST', '/brands/add', 'BrandController::add_post');
    $r->addRoute('POST', '/brands/check-name', 'BrandController::checkName');

    $r->addRoute('GET', '/brands/{id:\d+}/edit', 'BrandController::edit_get');
    $r->addRoute('POST', '/brands/{id:\d+}/edit', 'BrandController::edit_post');

    $r->addRoute('GET', '/brands/{id:\d+}/remove', 'BrandController::remove_get');
    $r->addRoute('POST', '/brands/{id:\d+}/remove', 'BrandController::remove_post');

	$r->addRoute('GET', '/cars', 'CarController::list');
	$r->addRoute('GET', '/cars/add', 'CarController::add_get');
	$r->addRoute('POST', '/cars/add', 'CarController::add_post');

    $r->addRoute('GET', '/cars/{id:\d+}/edit', 'CarController::edit_get');
    $r->addRoute('POST', '/cars/{id:\d+}/edit', 'CarController::edit_post');

    $r->addRoute('GET', '/cars/{id:\d+}/remove', 'CarController::remove_get');
    $r->addRoute('POST', '/cars/{id:\d+}/remove', 'CarController::remove_post');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);
$parse = explode('public', $uri);
$uri = end($parse);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        header('Content-type: text/plain');
        echo 'undefined route';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        
        list($controller, $method) = explode('::', $handler);
        $controller = 'App\\Controllers\\' . $controller;
        $object = new $controller;
        call_user_func_array([$object, $method], $vars);

        break;
}