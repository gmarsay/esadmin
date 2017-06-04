<?php
foreach ($data_all as $k => $v) {
  $_indexs[] = $k;
}

sort($_indexs);

foreach ($_indexs as $k=>$_index) {
  if (substr($_index, 0, 1) == '.') {
    unset($_indexs[$k]);
    $_indexs[] = $_index;
  }
}
?>

<?php foreach ($_indexs as $_index): ?>
  <li <?php if (substr($_index, 0, 1) == '.'):?> class="disabled"<?php endif; ?>>
    <a href="<?=url(array('index' => $_index), array('p', 'sort_by', 'sort_type', 'query_limit', 'query_position', 'admin', 'type'))?>"><?=$_index?></a>
  </li>
<?php endforeach; ?>

