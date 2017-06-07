<?php

namespace EsAdmin\Core;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use League\Plates\Engine;


class BaseController {

  protected $container;

  public function __construct($container) {
    $this->container = $container;
  }

  public function __call($name, $args) {
      $controller = $args[0];
      $action = $args[1];
      $request = $args[2];
      $response = $args[3];
      $args = $args[4];

      return $this->execute($controller, $action, $request, $response, $args);
  }


  public function execute($controller, $action, ServerRequestInterface $request, ResponseInterface $response, array $args) {
    $debug = $this->container->get('debug');
    $debug->addLog('info', 'BaseController::execute()');

    $context = $this->container->get('context');

include __DIR__.'/core.php';

$this->container->share('context', $context);

    if (!file_exists(__DIR__.'/controllers/'.$controller.'Controller.php')) {
      throw new Exception('BaseController error: unable to load controller '.__DIR__.'/controllers/'.$controller.'Controller.php');
    }

    include __DIR__.'/controllers/'.$controller.'Controller.php';

    $_controller_name = $controller.'Controller';
    $_action_name = $action.'Action';

    $debug->addLog('info', 'Instantiate '.$_controller_name);

    $instance = new $_controller_name($this->container);

    $debug->addLog('info', 'Call '.$_controller_name.'::'.$_action_name);

    $data = $instance->$_action_name($request, $response, $args);

    if (!file_exists(__DIR__.'/views/rest/'.$action.'.php')) {
      throw new Exception('BaseController error: unable to load template '.__DIR__.'/views/'.$controller.'/'.$action.'.php');
    }

    $template = new \League\Plates\Engine(__DIR__.'/views/'.$controller);

    $template->addData(['debug' => $debug]);
    $template->addData(['context' => $context]);

    $debug->addLog('info', 'Render template views/'.$controller);

    $response = new HtmlResponse($template->render($action, $data));

    return $response;
  }

}
