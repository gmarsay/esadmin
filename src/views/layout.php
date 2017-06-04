<?php include '../core.php'; ?>
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
      <?php include '_header.php'; ?>
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
        <?php else: ?>
          <h2>Welcome to ES Admin !</h2>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php include '_footer.php'; ?>
</body>
</html>
