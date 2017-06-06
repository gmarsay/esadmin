<?php
session_start();

if (isset($_GET['logout'])) {
  session_destroy();
}

if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['host'])) {
  $url = 'http://'.$_POST['login'].':'.$_POST['password'].'@'.$_POST['host'].'/';

  $ch = curl_init();
  curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset=UTF-8']
  ]);
  $response = curl_exec($ch);
  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  if ($http_code == 200) {
    session_start();

    $_SESSION['is_registred'] = true;
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['host'] = $_POST['host'];
    $_SESSION['port'] = $_POST['port'];

    header('location:/esadmin/');
  }
  else {
    $error = true;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>ES Admin</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body style="background: #eee;">
  <div class="" style="background: #fff; margin: auto auto; width: 450px; margin-top: 150px; padding: 15px; border: solid 1px #ddd; border-radius: 4px; box-shadow: 0px 0px 5px #ccc;">
    <h1 style="background: linear-gradient(154deg, #008fe2 0, #00b29c 100%); margin: -15px -15px 0px -15px; padding: 15px; font-size: 22px; color: #fff; border-top-left-radius: 4px; border-top-right-radius: 4px;">
      <img src="http://data.nimages.fr/esadminfsq.png" class="img-responsive" style="float: left; margin-right: 20px;">
      ES Admin<br/>
      <span style="font-size: 10px; text-transform: uppercase; color: #bbe2f6;">Elasticsearch Admin</span>
    </h1>

      <?php if (isset($_GET['logout'])): ?>
        <div class="alert alert-success" style="margin-top: 30px;">You are offline. Bye !</div>
      <?php endif; ?>

      <?php if (isset($error) && $error): ?>
        <div class="alert alert-danger" style="margin-top: 30px;">Authentication error.</div>
      <?php endif; ?>

      <form action="/login" method="POST" class="form-horizontal" style="margin-top: 30px;">
        <div class="form-group">
          <div class="col-sm-offset-1 col-sm-10">
            <input type="text" class="form-control" name="login" id="login" placeholder="Login (can be empty)">
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-1 col-sm-10">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password (can be empty)">
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-1 col-sm-7">
            <input type="text" class="form-control" name="host" id="host" placeholder="Host">
          </div>
          <div class="col-sm-3">
            <input type="number" class="form-control" name="port" id="port" placeholder="Port">
          </div>
        </div>

        <div class="form-group" style="margin-top: 30px;">
          <div class="col-sm-offset-1 col-sm-10">
            <button type="submit" class="btn btn-success btn-block" style="background: #00bca4; border-color: #00a792;">Login</button>
          </div>
        </div>
      </form>


      </form>
    </div>
  </div>
</div>
</body>
</html>
