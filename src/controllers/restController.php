<?php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RestController {

  protected $container;

  public function __construct($container) {
    $this->container = $container;
  }


  public function indexAction(ServerRequestInterface $request, ResponseInterface $response, $args) {
    $response = array();

    return $response;
  }
}
