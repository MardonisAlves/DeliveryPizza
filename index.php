<?php


session_cache_limiter('private');
//$cache_limiter = session_cache_limiter();

/* define o prazo do cache em 30 minutos */
session_cache_expire(30);
//$cache_expire = session_cache_expire();

session_start();


// Require application bootstrap
require __DIR__ . '/app/app.php';

// Run Slim
$app->run();
