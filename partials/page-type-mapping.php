<table class="table">
  <tr>
    <th>Field</th>
    <th>Type</th>
  </tr>
<?php foreach ($data_all->{$_GET['index']}->mappings->{$_GET['type']}->properties as $k=>$v): ?>
  <tr>
    <td><?=$k?></td>
    <td>
      <?=$v->type?>
      <?php if (isset($v->format)): ?> <small class="text-muted">(<?=$v->format?>)</small>  <?php endif; ?>

    </td>
  </tr>
<?php endforeach; ?>
</table>
