<ul id="header-stats">
  <li><i class="fa fa-server"></i> <strong><?=$data_stats->cluster_name?></strong></li>
  <li><?=$data_stats->_nodes->total?> <small>nodes</small></li>
  <li><?=$data_stats->indices->count?> <small>indices</small></li>
  <li><?=$data_stats->indices->shards->total?> <small>shards</small></li>
  <li><?=number_format($data_stats->indices->docs->count, 0, ',', ' ')?> <small>documents</small></li>
  <li><?=round($data_stats->indices->store->size_in_bytes/1024/1024/1024, 2)?> <small>GB</small></li>
  <li>
    <span style="margin-right: 5px;">Status</span>
    <?php if ($data_stats->status == 'green'): ?>
      <i class="fa fa-check-circle" style="color: #ffffff;"></i>
    <?php elseif ($data_stats->status == 'yellow'): ?>
      <i class="fa fa-exclamation-circle"style="color: #ffcc00;"></i>
    <?php else: ?>
      <i class="fa fa-exclamation-triangle" style="color: #ffcc00;"></i>
    <?php endif; ?>
</ul>
