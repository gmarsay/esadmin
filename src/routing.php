<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$container = new League\Container\Container;

$container->share('response', Zend\Diactoros\Response::class);
$container->share('request', function () {
    return Zend\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
    );
});

$container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);

$route = new League\Route\RouteCollection($container);


/* Temporary rules */
$route->map('GET', '/esadmin_dev/', function (ServerRequestInterface $request, ResponseInterface $response) {
  return $response;
});
/****/

$route->map('GET', '/esadmin_dev/{_controller}/{_action}', function (ServerRequestInterface $request, ResponseInterface $response, array $args) {
    $_controller = $args['_controller'].'Controller';
    $_controller = new $_controller();

    $_action = $args['_action'].'Action';
    return $_controller->$_action($request, $response, $args);
});

$route->map('GET', '/esadmin_dev/{_controller}', function (ServerRequestInterface $request, ResponseInterface $response, array $args) {
    $_controller = $args['_controller'].'Controller';
    $_controller = new $_controller();

    $_action = 'indexAction';
    return $_controller->$_action($request, $response, $args);
});


$response = $route->dispatch($container->get('request'), $container->get('response'));

$container->get('emitter')->emit($response);


