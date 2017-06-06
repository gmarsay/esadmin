<?php

require_once __DIR__.'/../vendor/autoload.php';

$context = (object) array();
$context->env = 'prod';

require_once __DIR__.'/../src/kernel.php';

require_once __DIR__.'/../src/routing.php';

require_once __DIR__.'/../src/app.php';
