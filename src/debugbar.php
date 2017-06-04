<?php

class debugbar {

  protected $log = array();
  protected $time = array();
  protected $context = array();
  protected $request = array();
  protected $elasticsearch = array();

  protected function __construct() {

  }

  public function addLog($level, $message) {

  }

  public function addTime($message, $start, $end=0) {

  }

  public function addContext($context) {
    $this->context = $context;
  }

  public function addRequest($name, $data) {
    $this->request[$name] = $data;
  }

  public function addElasticsearch($query, $response) {

  }

  public function renderLog() {
    echo 'Not implemented';
  }

  public function renderTime() {
    echo 'Not implemented';
  }

  public function renderContext() {
    var_dump($context);
  }

  public function renderRequest() {
    foreach ($this->request as $k => $v) {
      echo '<h4>'.$k.'</h4>';
      var_dump($v);
    }
  }

  public function renderElasticsearch() {
    echo 'Not implemented';
  }
}
