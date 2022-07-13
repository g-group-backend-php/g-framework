<?php

// Załączamy autoloader
require_once('vendor/autoload.php');

// Wywołujemy apkę
$app = new \App\App();
$app->run();
