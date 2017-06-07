<?php

require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/../src/BaseContext.php';
$context = new EsAdmin\Core\BaseContext;
$context->set('env', 'dev');

require_once __DIR__.'/../src/kernel.php';

require_once __DIR__.'/../src/app.php';
