<?php

namespace EsAdmin\Core;

class BaseView {

  protected $response = null;
  protected $path_views = __DIR__.'/views/';
  protected $path_layout = __DIR__.'/views/';
  protected $layout = 'layout';

  public function __construct($data = '') {
    $this->response = $data;
  }

  public function include_partial($path, $data = '', $base_path = '') {
    ob_start();

    if ($base_path == '') {
      $base_path = $this->path_views;
    }

    $path = $base_path.$path.'.php';
#    $data = (object) $data;
if ($path == '/data/www/netha.fr/esadmin/src/views/layout.php') {
  var_dump($data);
}
echo '<br>------------------------------------------<br>';
    if (!file_exists($path)) {
      throw new \Exception('BaseView error on include '.$path.'. File does not exists.');
    }

    include $path;

    $this->response.= ob_get_clean();

    return $this->response;
  }


  public function setLayout($path) {
    $this->layout($path);
  }


  public function render($path, $data = '') {
    if ($data == '') {
      $data = $this->response;
    }

    $this->include_partial($path, $this->response);
    $this->include_partial($this->layout, $this->response);

    if ($this->response == null) {
      throw new \Exception('BaseView error on render. $html is empty.');
    }

    return $this->response;
  }
}
