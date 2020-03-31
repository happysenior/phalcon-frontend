<?php

$router = new \Phalcon\Mvc\Router();
$router->removeExtraSlashes(true);

// Define your routes here
$router->add('/auth/credentials', ['controller' => 'auth', 'action'=>'getCredentials']);

$router->handle();

return $router;
