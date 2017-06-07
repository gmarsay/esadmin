<?php
function url($new_params = array(), $delete_params = array()) {
  $get_params = $_GET;

  foreach ($new_params as $k=>$v) {
    $get_params[$k] = $v;
  }

  foreach ($delete_params as $k) {
    if (array_key_exists($k, $get_params)) {
      unset($get_params[$k]);
    }
  }

  $url = '?';

  foreach ($get_params as $k => $v) {
    if (is_array($v)) {
      foreach ($v as $subkey=>$subvalue) {
        $url.= $k.'['.$subkey.']='.$subvalue.'&';
      }
    }
    else {
      $url.= $k.'='.$v.'&';
    }
  }

  $url = substr($url, 0, -1);

  return $url;
}
