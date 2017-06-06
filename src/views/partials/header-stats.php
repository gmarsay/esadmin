<ul id="header-stats">
  <li><i class="fa fa-server"></i> <strong><?=$this->e($es_cluster_name)?></strong></li>
  <li><?=$this->e($es_total_nodes)?> <small>nodes</small></li>
  <li><?=$this->e($es_total_indices)?> <small>indices</small></li>
  <li><?=$this->e($es_total_shards)?> <small>shards</small></li>
  <li><?=$this->e($es_total_docs)?> <small>documents</small></li>
  <li><?=$this->e($es_total_size)?> <small>GB</small></li>
  <li>
    <span style="margin-right: 5px;">Status</span>
    <?php if ($this->e($es_status) == 'green'): ?>
      <i class="fa fa-check-circle" style="color: #ffffff;"></i>
    <?php elseif ($this->e($es_status) == 'yellow'): ?>
      <i class="fa fa-exclamation-circle"style="color: #ffcc00;"></i>
    <?php else: ?>
      <i class="fa fa-exclamation-triangle" style="color: #ffcc00;"></i>
    <?php endif; ?>
</ul>

