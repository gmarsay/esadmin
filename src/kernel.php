<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use EsAdmin\Core\DebugbarCore;

Debug::enable();
ErrorHandler::register();
ExceptionHandler::register();

require_once __DIR__.'/BaseDebugbar.php';
$debug = new EsAdmin\Core\BaseDebugbar();

require_once __DIR__.'/BaseSecurity.php';

require_once __DIR__.'/BaseController.php';

require_once __DIR__.'/routing.php';
