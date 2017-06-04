<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/kernel.php';

use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

$context->env = 'dev';

Debug::enable();
ErrorHandler::register();
ExceptionHandler::register();

require_once __DIR__.'/../src/app.php';
