<?php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ClusterController {

  protected $container;

  public function __construct($container) {
    $this->container = $container;
    $this->context = $this->container->get('context');
  }


  public function indexAction(ServerRequestInterface $request, ResponseInterface $response, $args) {
    $es_url = $this->context->get('elasticsearch.baseurl');

    $es_data = $es_url.'_cat/nodes?format=json&pretty=true';
    $_data = file_get_contents($es_data);
    $args['nodes'] = json_decode($_data);

    $es_data_indices = $es_url.'_cat/indices?format=json&pretty=true';
    $_data_indices = file_get_contents($es_data_indices);
    $args['indices'] = json_decode($_data_indices);

    $es_data_shards = $es_url.'_cat/shards?format=json&pretty=true';
    $_data_shards = file_get_contents($es_data_shards);
    $args['shards'] = json_decode($_data_shards);

    $response = $args;

    return $response;
  }
}
