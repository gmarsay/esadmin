<?php

namespace EsAdmin\Core;

class BaseContext {

  protected $context = array();


  public function set($name, $value) {
    $this->context[$name] = $value;
  }


  public function get($name) {
    return $this->context[$name];
  }
}
