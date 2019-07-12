<?php


session_start();


// Require application bootstrap
require __DIR__ . '/app/app.php';

// Run Slim
$app->run();
