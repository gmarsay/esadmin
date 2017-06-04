<nav>
  <div class="nav-header">
    <img src="http://data.nimages.fr/esadminfsq.png" class="img-responsive">
    <h1>ES Admin</h1>
    <span>Elasticsearch Admin</span>
  </div>

  <div class="nav-content">
    <h3>Indices</h3>
    <div class="dropdown">
      <a id="dropdownIndex" class="btn-dropdown dropdown-toggle" type="button" data-toggle="dropdown">
        <?php if (isset($_GET['index'])): ?>
          <i class="fa fa-database"></i> <?=$_GET['index']?>
        <?php else: ?>
          Select index...
        <?php endif; ?>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" aria-labelledby="dropdownIndex">
        <?php include 'partials/nav-list-index.php'; ?>
      </ul>
    </div>
    <div class="nav-list-type">
      <?php if (isset($_GET['index'])): ?>
        <?php include 'partials/nav-list-type.php'; ?>
      <?php endif; ?>
    </div>

    <h3>Administration</h3>
    <div class="nav-list-administration">
      <ul>
        <li <?php if (isset($_GET['admin']) && $_GET['admin'] == 'cluster'): ?>class="active"<?php endif; ?>><a href="?admin=cluster"><i class=" fa fa-server"></i> Cluster</a></li>
        <li <?php if (isset($_GET['admin']) && $_GET['admin'] == 'rest-api'): ?>class="active"<?php endif; ?>><a href="?admin=rest-api"><i class=" fa fa-puzzle-piece"></i> REST API</a></li>
        <li <?php if (isset($_GET['admin']) && $_GET['admin'] == 'acl'): ?>class="active"<?php endif; ?>><a href="#"><i class=" fa fa-key"></i> Security / ACL</a></li>
        <li><a href="login.php?logout=true"><i class=" fa fa-sign-out"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
