<h2>Administration <span class="text-muted">/</span> REST API</h2>


<div class="row">
  <div class="col-md-6">
    <form class="form-horizontal">
      <div class="row">
        <div class="col-sm-10">
          <input class="form-control" type="text" id="editor-form-path" name="editor-form-path" placeholder="path (eg: indexName/_search)">
        </div>
        <div class="col-sm-2">
          <select class="form-control" id="editor-form-method" name="editor-form-method"">
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
          </select>
        </div>
      </div>
      <div class="row" style="margin-top: 5px;">
        <div class="col-sm-12">
          <textarea id="editor" class="form-control" rows="20" style="white-space: pre; font-family: monospace;">{}</textarea>
          <div id="editor-status"><span id="editor-status-icon"></span><span id="editor-status-message"></span></div>
        </div>
      </div>
      <div class="row pull-right" style="margin-top: 5px;">
        <div class="col-sm-12">
          <a id="editor-button-format" class="btn btn-default" href="javascript:void(0);" onclick="format_json()"><i class="fa fa-align-left"></i> Format</a>
          <a id="editor-button-send" class="btn btn-primary" href="javascript:void(0);" onclick="if ($('#editor-form-method').val() == 'DELETE') { if (confirm('Deleting... Are you sur ?')) { format_json(); }}"><i class="fa fa-bolt"></i> Send</a>
        </div>
      </div>
    </form>
  </div>

  <div class="col-md-6">
    <div id="editor-results">
      <em class="text-muted">No query.</em>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  syntax_json();
});

function syntax_json() {
  var data = document.getElementById('editor').value;
  try {
    var syntax = eval(JSON.parse(data));

    $('#editor-status-icon').html('<i class="fa fa-check-circle"></i>');
    $('#editor-status-message').text('Syntax OK');

    $('#editor-status').removeClass('text-danger');
    $('#editor-status').addClass('text-primary');
    $('#editor-button-send').removeClass('disabled');
  }
  catch (err) {
    message = err.message;
    message = message.replace('JSON.parse: ', '');

    $('#editor-status-icon').html('<i class="fa fa-exclamation-triangle"></i>');
    $('#editor-status-message').text(message);

    $('#editor-status').removeClass('text-primary');
    $('#editor-status').addClass('text-danger');
    $('#editor-button-send').addClass('disabled');
  }

  setTimeout(syntax_json, 1000);
}

function format_json() {
  var ugly = document.getElementById('editor').value;
  var obj = JSON.parse(ugly);
  var pretty = JSON.stringify(obj, undefined, 2);
  document.getElementById('editor').value = pretty;
}
</script>

<style>
#editor-status {
  background: #f7f7fb;
  height: 24px;
  line-height: 20px;
  margin-top: -25px;
  margin-left: 1px;
  margin-right: 1px;
  padding: 2px 10px 2px 10px;
  z-index: 100;
  font-size: 12px;
  border-bottom-left-radius: 4px;
  border-bottom-right-radius: 4px;
  border-top: solid 1px #ddd;
}
#editor-status-icon {
  margin-right: 10px;
}
#editor-status-message {
}
#editor-results {
  background: #ffffff;
  border: solid 1px #dddddd;
  border-radius: 4px;
  padding: 10px;
}
</style>

