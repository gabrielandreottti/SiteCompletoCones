<?php
declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));
define('VIEW_PATH', ROOT_PATH . '/Views');
define('MODEL_PATH', ROOT_PATH . '/Models');
define('CONTROLLER_PATH', ROOT_PATH . '/Controllers');

$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
define('BASE_URL', $basePath === '/' ? '' : $basePath);
