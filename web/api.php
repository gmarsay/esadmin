<?php

require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/../src/kernel.php';

$context = (object) array();
$context->env = 'prod';

require_once __DIR__.'/../core.php';

