<?php foreach ($data_all->{$_GET['index']}->mappings as $k => $v): ?>
  <?php $_types[] = $k; ?>
<?php endforeach; ?>

<?php sort($_types); ?>

<ul>
<?php foreach ($_types as $_type): ?>
  <li <?php if (isset($_GET['type']) && $_GET['type'] == $_type): ?>class="active"<?php endif; ?>>
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
      <i class="fa fa-table"></i> <?=$_type?>
    </a>
  </li>
<?php endforeach; ?>
</ul>
