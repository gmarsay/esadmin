<?php
include __DIR__.'/../../core.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>ES Admin</title>
  <link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link href="/public/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/public/assets/styles.css" rel="stylesheet">
  <link href="/public/assets/debug.css" rel="stylesheet">
  <script src="/public/jquery/jquery.min.js"></script>
  <script src="/public/bootstrap/js/bootstrap.min.js"></script>
  <script src="/public/assets/app.js"></script>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <?php $this->insert('../_header', [
        'es_cluster_name' => $data_stats->cluster_name,
        'es_total_nodes' => $data_stats->_nodes->total,
        'es_total_indices' => $data_stats->indices->count,
        'es_total_shards' => $data_stats->indices->shards->total,
        'es_total_docs' => number_format($data_stats->indices->docs->count, 0, ',', ' '),
        'es_total_size' => round($data_stats->indices->store->size_in_bytes/1024/1024/1024, 2),
        'es_status' => $data_stats->status
      ]) ?>
    </div>
  </div>

  <div class="row">
    <div class="col-md-2">
      <?php include '_navigation.php'; ?>
    </div>
    <div class="col-md-10">
      <div id="content">
        <?php if (isset($_GET['type'])): ?>
          <?php include 'partials/content-info-type.php'; ?>
        <?php elseif (isset($_GET['index'])): ?>
          <?php include 'partials/content-info-index.php'; ?>
        <?php elseif (isset($_GET['admin'])): ?>
          <?php include 'partials/admin-'.$_GET['admin'].'.php'; ?>
        <?php endif; ?>
        <?=$this->section('content')?>
      </div>
    </div>
  </div>
</div>

<?php include '_footer.php'; ?>
</body>
</html>
