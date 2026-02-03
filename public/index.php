<?php
declare(strict_types=1);

define('APP_PATH', dirname(__DIR__));

require_once APP_PATH . '/vendor/autoload.php';

use App\App;

$app = new App();

echo $app->hello();