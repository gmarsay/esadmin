<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use EsAdmin\Core\BaseController;

$container = new League\Container\Container;

$container->share('debug', $debug);
$container->share('context', $context);

$container->share('response', Zend\Diactoros\Response::class);
$container->share('request', function () {
    return Zend\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
    );
});

$container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);

$route = new League\Route\RouteCollection($container);


/* Temporary rules */
$route->map('GET', '/{env}/', function (ServerRequestInterface $request, ResponseInterface $response) {
  return $response;
});
/****/

$route->map('GET', '/{env}/{_controller}/{_action}', function (ServerRequestInterface $request, ResponseInterface $response, array $args) {
    $_controller = $args['_controller'];
    $_action = $args['_action'];

    $controller = $_controller.'Controller';
    $action = $_action.'Action';

    $container->get('debug')->addLog('info', 'Instantiate BaseController');
    $baseController = new EsAdmin\Core\BaseController($container);

    return $baseController->$action($_controller, $_action, $request, $response, $args);
});


$route->map('GET', '/{env}/{_controller}', function (ServerRequestInterface $request, ResponseInterface $response, array $args) use ($container) {
    $_controller = $args['_controller'];
    $_action = 'index';

    $controller = $_controller.'Controller';
    $action = $_action.'Action';

    $container->get('debug')->addLog('info', 'Instantiate BaseController');
    $baseController = new EsAdmin\Core\BaseController($container);

    return $baseController->$action($_controller, $_action, $request, $response, $args);
});


$response = $route->dispatch($container->get('request'), $container->get('response'));

$container->get('emitter')->emit($response);


