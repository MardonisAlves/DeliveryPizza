<?php


session_start();

$twig->addGlobal("session", $_SESSION);
// Require application bootstrap
require __DIR__ . '/app/app.php';

// Run Slim
$app->run();
