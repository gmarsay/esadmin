<?php
session_start();

if (!$_SESSION['is_registred']) {
  header('location:login.php');
}

$context->elasticsearch = (object) array();
$context->elasticsearch->login = $_SESSION['login'];
$context->elasticsearch->password = $_SESSION['password'];
$context->elasticsearch->host = $_SESSION['host'];
$context->elasticsearch->port = $_SESSION['port'];

$es_url = 'http://'.$context->elasticsearch->login.':'.$context->elasticsearch->password.'@'.$context->elasticsearch->host.':'.$context->elasticsearch->port.'/';
$context->elasticsearch->baseurl = $es_url;

$es_all = $es_url.'_all';
$data_all = file_get_contents($es_all);
$data_all = json_decode($data_all);

$es_stats = $es_url.'_cluster/stats';
$data_stats = file_get_contents($es_stats);
$data_stats = json_decode($data_stats);


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




if (isset($_GET['api'])) {
  include 'src/views/'.$_GET['api'].'.php';
  exit;
}


