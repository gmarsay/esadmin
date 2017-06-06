<?php
$es_query = $es_url.$_GET['index'].'/'.$_GET['type'].'/_search';

if (isset($_GET['sort_by'])) {
  $_sort_by = $_GET['sort_by'];
  $_sort_type = $_GET['sort_type'];
}
else {
  $_sort_by = '_uid';
  $_sort_type = 'desc';
}

$_query_filter = '';

if (!isset($_GET['query_filter']) || count($_GET['query_filter']) == 0) {
  $_query_filter.= '"query": {
    "match_all": {}
  },';

}
else {
  $_query_filter.= '"query": {
    "constant_score": {
      "filter": {
        "bool": {
          "must": [
  ';

  foreach ($_GET['query_filter'] as $k=>$v) {
    if ($v) {
      $_query_filter.= '          { "wildcard": { "'.$k.'": "'.$v.'" } },';
    }
  }

  $_query_filter = substr($_query_filter, 0, -1);

  $_query_filter.= '          ]
        }
      }
    }
  },';
}

$data = '{
  '.$_query_filter.'
  "sort": [
    { "'.$_sort_by.'": {"order": "'.$_sort_type.'"}}
  ],
  "from": '.$_GET['query_position'].',
  "size": '.$_GET['query_limit'].'
}';

$ch = curl_init();
curl_setopt_array($ch, [
  CURLOPT_URL => $es_query,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset=UTF-8']
]);
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$_data = json_decode($response);

$query_max_row = $_data->hits->total;
?>


<div class="toolbox pull-right">
  <i class="text-muted">Show <?=$_GET['query_limit']?> rows, start at position <?=$_GET['query_position']?></i>

  <div class="btn-group">

    <?php if ($_GET['query_position'] > 0): ?>
    <a class="btn btn-default" href="<?=url(array('query_position' => 0))?>" class="text-muted"><i class="fa fa-angle-double-left"></i></a>
      <a class="btn btn-default" href="<?=url(array('query_position' => $_GET['query_position']-$_GET['query_limit']))?>"><i class="fa fa-angle-left"></i></a>
    <?php else: ?>
      <span class="btn btn-default disabled" href="<?=url(array('query_position' => 0))?>" class="text-muted"><i class="fa fa-angle-double-left"></i></span>
      <span class="btn btn-default disabled" class="text-muted"><i class="fa fa-angle-left"></i></span>
    <?php endif; ?>

    <?php if ($_GET['query_position'] < $query_max_row-$_GET['query_limit']): ?>
      <a class="btn btn-default" href="<?=url(array('query_position' => $_GET['query_position']+$_GET['query_limit']))?>"><i class="fa fa-angle-right"></i></a>
      <a class="btn btn-default" href="<?=url(array('query_position' => $query_max_row-$_GET['query_limit']))?>" class="text-muted"><i class="fa fa-angle-double-right"></i></a>
    <?php else: ?>
      <span class="btn btn-default disabled" class="text-muted"><i class="fa fa-angle-right"></i></span>
      <span class="btn btn-default disabled" href="<?=url(array('query_position' => $query_max_row-$_GET['query_limit']))?>" class="text-muted"><i class="fa fa-angle-double-right"></i></span>
    <?php endif; ?>

  </div>

  <a class="btn btn-default" href="<?=url()?>"><i class="fa fa-refresh"></i></a>

  <a class="btn btn-default" href="#" onclick="$('.query_filter').toggle()"><i class="fa fa-filter"></i></a>

  <a class="btn btn-default" href="#" onclick="$('.raw_query').toggle()"><i class="fa fa-file-text-o"></i></a>
</div>

<div style="clear: right;"></div>

<div class="query_filter" style="width: 50%;">
  <h3>Filters</h3>
  <p class="text-muted">Use wildcard "*" for any characters or "?" for single character.</p>
  <form action="<?=url()?>" method="GET" class="form-horizontal">
    <?php foreach ($_GET as $k=>$v): ?>
      <?php if (is_array($v)): ?>
        <?php foreach ($v as $subkey=>$subvalue): ?>
          <input type="hidden" name="<?=$k?>[<?=$subkey?>]" value="<?=$subvalue?>">
        <?php endforeach; ?>
      <?php else: ?>
        <input type="hidden" name="<?=$k?>" value="<?=$v?>">
      <?php endif; ?>
    <?php endforeach; ?>

    <?php foreach ($data_all->{$_GET['index']}->mappings->{$_GET['type']}->properties as $field => $field_type): ?>
      <?php if (in_array($field_type->type, array('keyword', 'text'))): ?>
        <div class="form-group">
          <label for="form-<?=$field?>" class="col-sm-2 control-label"><?=$field?></label>
          <div class="col-sm-10">
            <input
              type="text"
              class="form-control"
              name="query_filter[<?=$field?>]"
              id="form-<?=$field?>"
              placeholder="<?=$field?>"
              <?php if (isset($_GET['query_filter'][$field]) && $_GET['query_filter'][$field]): ?> value="<?=$_GET['query_filter'][$field]?>" <?php endif; ?>
            >
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
        <a class="btn btn-danger" href="<?=url(array(), array('query_filter'))?>">Reset</a>
      </div>
    </div>
  </form>
</div>

<div class="raw_query">
  <div>
    <span class="raw_query_method">POST</span>
    <span class="raw_query_url"><?=$es_query?></span>
  </div>
  <pre>
<?=$data?>
  </pre>
</div>


<table class="table table-striped table-condensed table-hover">
  <tr>
    <th width="10"></th>
  <?php foreach ($data_all->{$_GET['index']}->mappings->{$_GET['type']}->properties as $k=>$v): ?>
    <th>
      <?php if (isset($_GET['sort_type']) && $_GET['sort_type'] == 'asc'): $_sort_type = 'desc'; else: $_sort_type = 'asc'; endif; ?>
      <a href="<?=url(array('sort_by' => $k, 'sort_type' => $_sort_type))?>"><?=$k?></a>
      <?php if ($_GET['sort_by'] == $k && $_GET['sort_type'] == 'asc'):?><i class="fa fa-caret-up"></i><?php endif; ?>
      <?php if ($_GET['sort_by'] == $k && $_GET['sort_type'] == 'desc'):?><i class="fa fa-caret-down"></i><?php endif; ?>
    </th>
  <?php endforeach; ?>
    <th width="60"></th>
  </tr>
  <?php foreach ($_data->hits->hits as $k => $v): ?>
    <tr data-id="<?=$v->_id?>">
      <td><input type="checkbox"></td>
      <?php foreach ($data_all->{$_GET['index']}->mappings->{$_GET['type']}->properties as $field => $field_type): ?>
        <?php if (property_exists($v->_source, $field)): ?>
          <td><?=$v->_source->{$field}?></td>
        <?php else: ?>
          <td></td>
        <?php endif; ?>
      <?php endforeach; ?>
      <td>
        <a class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>
        <a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="if (confirm('Are you sur ?')) { es_delete_by_id('<?=$v->_id?>'); };"><i class="fa fa-remove"></i></a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>


<script>
function es_delete_by_id(id) {
  $('tr[data-id="'+id+'"] td').addClass('text-muted');

  $.ajax({
    method: "DELETE",
    crossDomain: true,
    url: "http://<?=$_SESSION['host']?>:<?=$_SESSION['port']?>/<?=$_GET['index']?>/<?=$_GET['type']?>/"+id,

    headers: {
      "Authorization":  "Basic "+btoa('<?=$_SESSION['login']?>:<?=$_SESSION['password']?>'),
      "Content-Type": "application/json",
    },

/*
    username: "<?=$_SESSION['login']?>",
    password: "<?=$_SESSION['password']?>",
*/
    data: {},
  })
  .done(function(data, status) {
    if (status == 'success') {
      $('tr[data-id="'+id+'"]').hide();
    }
    else {
      $('tr[data-id="'+id+'"] td').addClass('text-danger');
      console.log('Request error.');
    }
  });
}
</script>
