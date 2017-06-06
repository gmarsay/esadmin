<?php if ($context->env == 'dev'): ?>
<div id="debug">
  <ul class="nav nav-tabs">
    <li id="debug-log-link" class="debug-tab-link"><a href="javascript:void(0);" onclick="debug_navigation('log');">Log</a></li>
    <li id="debug-time-link" class="debug-tab-link"><a href="javascript:void(0);" onclick="debug_navigation('time');">Time</a></li>
    <li id="debug-context-link" class="debug-tab-link"><a href="javascript:void(0);" onclick="debug_navigation('context');">Context</a></li>
    <li id="debug-request-link" class="debug-tab-link"><a href="javascript:void(0);" onclick="debug_navigation('request');">Request</a></li>
    <li id="debug-elasticsearch-link" class="debug-tab-link"><a href="javascript:void(0);" onclick="debug_navigation('elasticsearch');">Elasticsearch</a></li>
  </ul>

  <div id="debug-log" class="debug-tab" style="display: none;">
    <h3>Log</h3>
    <div>
      <i>Not implemented</i>
    </div>
  </div>

  <div id="debug-time" class="debug-tab" style="display: none;">
    <h3>Time</h3>
      <div>
      <i>Not implemented</i>
    </div>
  </div>

  <div id="debug-context" class="debug-tab" style="display: none;">
    <h3>Context</h3>
    <div>
      <?php var_dump($context); ?>
    </div>
  </div>

  <div id="debug-request" class="debug-tab" style="display: none;">
    <h3>Request</h3>
    <div>

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
  </div>

  <div id="debug-elasticsearch" class="debug-tab" style="display: none;">
    <h3>Elasticsearch</h3>
    <div>
      <i>Not implemented</i>
    </div>
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
