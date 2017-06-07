<?php $this->layout('../layout', [
  'title' => 'Cluster',
]) ?>

<h2>Administration <span class="text-muted">/</span> Cluster</h2>

<table class="table table-striped table-hover admin-cluster">
  <tr>
    <td width="250"></td>
<?php foreach ($this->data['indices'] as $indice): ?>
  <?php if (substr($indice->index, 0, 1) != '.'): ?>
    <td>
      <strong <?php if ($indice->status != 'open'):?> class="text-muted"<?php endif; ?>>
        <?php if ($indice->health == 'green'): ?>
          <i class="fa fa-check-circle text-success"></i>
        <?php elseif ($indice->health == 'yellow'): ?>
          <i class="fa fa-exclamation-circle text-warning"></i>
        <?php else: ?>
          <i class="fa fa-exclamation-triangle text-danger"></i>
        <?php endif; ?>
        <?=$indice->index?>
      </strong>
      <br/>
      <?php if ($indice->status == 'open'):?>
        <small class="text-muted"><?=number_format($indice->{'docs.count'}, 0, ',', ' ')?> docs | <?=$indice->{'store.size'}?></small>
      <?php endif; ?>
    </td>
  <?php endif; ?>
<?php endforeach; ?>
  </tr>
<?php foreach ($this->data['nodes'] as $node): ?>
  <?php if (substr($node->{'node.role'}, 0, 1) == 'm'): ?>
    <?php $icon = 'star-o'; ?>
  <?php elseif (substr($node->{'node.role'}, 0, 1) == 'd'): ?>
    <?php $icon = 'save'; ?>
  <?php else: ?>
    <?php $icon = 'leaf'; ?>
  <?php endif; ?>

  <?php if ($node->master == '*'): ?>
    <?php $icon = 'star'; ?>
  <?php endif; ?>
  <tr>
    <td>
      <h3><i class="fa fa-<?=$icon?>"></i> <?=$node->name?></h3>
      <?=$node->ip?><br/>
      <small class="text-muted">
      CPU : <?=$node->cpu?>% | LOAD : <?=$node->load_1m?> | RAM : <?=$node->{'ram.percent'}?>%
      </small>
    </td>
    <?php foreach ($this->data['indices'] as $indice): ?>
      <?php if (substr($indice->index, 0, 1) != '.'): ?>
        <td>
        <?php foreach ($this->data['shards'] as $shard): ?>
          <?php $shard_node_current = explode(' -> ', $shard->node)[0]; ?>
          <?php if ($indice->index == $shard->index && $node->name == $shard_node_current): ?>
            <span class="shard shard-<?=$shard->prirep?>-<?=$shard->state?>" data-toggle="tooltip" data-placement="bottom" title="<?=ucfirst(strtolower($shard->state))?> | <?=number_format($shard->docs, 0, ',', ' ')?> docs | <?=$shard->store?>"><?=$shard->shard?></span>
          <?php endif; ?>
        <?php endforeach; ?>
        </td>
      <?php endif; ?>
    <?php endforeach; ?>
  </tr>
<?php endforeach; ?>
  <tr>
    <td></td>
    <?php foreach ($this->data['indices'] as $indice): ?>
      <?php if (substr($indice->index, 0, 1) != '.'): ?>
        <td>
        <?php foreach ($this->data['shards'] as $shard): ?>
          <?php $shard_node_current = explode(' -> ', $shard->node)[0]; ?>
          <?php if ($indice->index == $shard->index && $shard->state == 'UNASSIGNED'): ?>
            <span class="shard shard-<?=$shard->prirep?>-<?=$shard->state?>" data-toggle="tooltip" data-placement="bottom" title="<?=ucfirst(strtolower($shard->state))?> | <?=number_format($shard->docs, 0, ',', ' ')?> docs | <?=$shard->store?>"><?=$shard->shard?></span>
          <?php endif; ?>
        <?php endforeach; ?>
        </td>
      <?php endif; ?>
    <?php endforeach; ?>
  </tr>
</table>

<script>
$(document).ready(function() {
  $('.shard').tooltip();
});
</script>
