<?php include '../core.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>ES Admin</title>
  <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link href="public/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="public/assets/styles.css" rel="stylesheet">
  <link href="public/assets/debug.css" rel="stylesheet">
  <script src="public/jquery/jquery.min.js"></script>
  <script src="public/bootstrap/js/bootstrap.min.js"></script>
  <script src="public/assets/app.js"></script>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <header>
        <div id="header-info" class="pull-right">
          <?php include 'partials/header-stats.php'; ?>
        </div>
      </header>
    </div>
  </div>

  <div class="row">
    <div class="col-md-2">
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
            <ul class="dropdown-menu" aria-labelledby="dropdownIndexx">
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
    </div>
    <div class="col-md-10">
      <div id="content">
        <?php if (isset($_GET['type'])): ?>
          <?php include 'partials/content-info-type.php'; ?>
        <?php elseif (isset($_GET['index'])): ?>
          <?php include 'partials/content-info-index.php'; ?>
        <?php elseif (isset($_GET['admin'])): ?>
          <?php include 'partials/admin-'.$_GET['admin'].'.php'; ?>
        <?php else: ?>
          <h2>Welcome to ES Admin !</h2>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php if ($context->env == 'dev'): ?>
<div id="debug">
  <ul class="nav nav-tabs">
    <li id="debug-log-link" class="debug-tab-link"><a href="javascript:void(0);" onclick="debug_navigation('log');">Log</a></li>
    <li id="debug-time-link" class="debug-tab-link"><a href="javascript:void(0);" onclick="debug_navigation('time');">Time</a></li>
    <li id="debug-context-link" class="debug-tab-link"><a href="javascript:void(0);" onclick="debug_navigation('context');">Context</a></li>
    <li id="debug-request-link" class="debug-tab-link"><a href="javascript:void(0);" onclick="debug_navigation('request');">Request</a></li>
    <li id="debug-elasticsearch-link" class="debug-tab-link"><a href="javascript:void(0);" onclick="debug_navigation('elasticsearch');">Elasticsearch</a></li>
  </ul>

  <div id="debug-log" class="debug-tab">
    <h3>Log</h3>
    <i>Not implemented</i>
  </div>

  <div id="debug-time" class="debug-tab" style="display: none;">
    <h3>Time</h3>
    <i>Not implemented</i>
  </div>

  <div id="debug-context" class="debug-tab" style="display: none;">
    <h3>Context</h3>
    <?php var_dump($context); ?>
  </div>

  <div id="debug-request" class="debug-tab" style="display: none;">
    <h3>Request</h3>

    <h4>GET</h4>
    <?php var_dump($_GET); ?>

    <h4>POST</h4>
    <?php var_dump($_POST); ?>

    <h4>SESSION</h4>
    <?php var_dump($_SESSION); ?>

    <h4>COOKIE</h4>
    <?php var_dump($_COOKIE); ?>

    <h4>SERVER</h4>
    <?php var_dump($_SERVER); ?>
  </div>

  <div id="debug-elasticsearch" class="debug-tab" style="display: none;">
    <h3>Elasticsearch</h3>
    <i>Not implemented</i>
  </div>
</div>

<script>
function debug_navigation(item) {
  $('.debug-tab-link').removeClass('active');
  $('#debug-'+item+'-link').addClass('active');
  $('.debug-tab').hide();
  $('#debug-'+item).show();
}
</script>
<?php endif; ?>

<footer class="footer">
  <div class="container-fluid">
    <div>
      ELASTICSEARCH ADMIN <?=file_get_contents('../VERSION');?>
      <div class="pull-right">
        <ul>
          <li>Github</li>
          <li>Help</li>
          <li>Changelog</li>
          <li>About</li>
        </ul>
      </div>
    </div>
  </div>
</footer>
</body>
</html>
