<?php

use Dotenv\Dotenv;

$dotEnv = Dotenv::createUnsafeImmutable(APP_ROOT);
$dotEnv->load();
require_once "_stripe.php";