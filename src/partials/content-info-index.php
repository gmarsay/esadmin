<h2><?=$_GET['index']?></h2>

<ul class="index-icons">
<?php foreach ($_types as $_type): ?>
  <li>
    <a
      href="<?=url(
        array(
          'type' => $_type,
          'p' => 'type-data',
          'query_limit' => 30,
          'query_position' => 0,
          'sort_by' => '_uid',
          'sort_type' => 'desc',
        ),
        array(
          'admin',
          'query_filter'
        )
      )?>">
      <i class="fa fa-table"></i>
      <span><?=$_type?></span>
    </a>
  </li>
<?php endforeach; ?>
</ul>

<?php
function recursive_array($array) {
  foreach ($array as $k=>$v) {
    if (is_array($v)) {
      echo $k.'.';
      recursive_array($v);
    }
    else {
      echo $k.'  :  '.$v.'<br>';
    }
  }
}
?>

<pre>
<?php recursive_array(json_decode(json_encode($data_all->{$_GET['index']}->settings), true)); ?>
</pre>
