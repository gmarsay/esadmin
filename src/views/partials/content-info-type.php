<h2><?=$_GET['index']?> <span class="text-muted">/</span> <?=$_GET['type']?></h2>

<ul class="nav nav-tabs">
  <li <?php if ($_GET['p'] == 'type-mapping'):?> class="active"<?php endif;?>><a href="<?=url(array('p' => 'type-mapping'))?>">Mapping</a></li>
  <li <?php if ($_GET['p'] == 'type-data'):?> class="active"<?php endif;?>><a href="<?=url(array('p' => 'type-data'))?>">Data</a></li>
</ul>

<div class="page-content">
  <?php include __DIR__.'/page-'.$_GET['p'].'.php'; ?>
</div>
