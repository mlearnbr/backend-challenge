<?php
 require 'vendor/autoload.php';

// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false,
]];

$app = new \Slim\App($config);

// Define app routes
$app->get('/', function ($request, $response, $args) {
    $file = 'public/views/index.html';
    return $response->write(file_get_contents($file));
});

//User routes
require 'src/routes/users.php';

// Run app
$app->run();