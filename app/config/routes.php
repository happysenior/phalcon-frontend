<?php
$di = new \Phalcon\Di\FactoryDefault();
$router = new \Phalcon\Mvc\Router();
$router->setDI($di);
$router->setDefaultController('index')->setDefaultAction('index');
$router->removeExtraSlashes(true);

// Define your routes here
$router->add('/auth/credentials', ['controller' => 'auth', 'action'=>'getCredentials']);
$router->add('/kid', ['controller' => 'Kid', 'action'=>'index']);



// API WRAPPER
$router->addGet('/v1/{path0}', ['controller' => 'Api', 'action'=>'get']);
$router->addGet('/v1/{path0}/{path1}', ['controller' => 'Api', 'action'=>'get']);
$router->addGet('/v1/{path0}/{path1}/{path2}', ['controller' => 'Api', 'action'=>'get']);
$router->addGet('/v1/{path0}/{path1}/{path2}/{path3}', ['controller' => 'Api', 'action'=>'get']);
$router->addGet('/v1/{path0}/{path1}/{path2}/{path3}/{path4}', ['controller' => 'Api', 'action'=>'get']);

$router->addPost('/v1/{path0}', ['controller' => 'Api', 'action'=>'post']);
$router->addPost('/v1/{path0}/{path1}', ['controller' => 'Api', 'action'=>'post']);
$router->addPost('/v1/{path0}/{path1}/{path2}', ['controller' => 'Api', 'action'=>'post']);
$router->addPost('/v1/{path0}/{path1}/{path2}/{path3}', ['controller' => 'Api', 'action'=>'post']);
$router->addPost('/v1/{path0}/{path1}/{path2}/{path3}/{path4}', ['controller' => 'Api', 'action'=>'post']);$router->addPost('/v1/{path0}', ['controller' => 'Api', 'action'=>'post']);

$router->addPut('/v1/{path0}', ['controller' => 'Api', 'action'=>'put']);
$router->addPut('/v1/{path0}/{path1}', ['controller' => 'Api', 'action'=>'put']);
$router->addPut('/v1/{path0}/{path1}/{path2}', ['controller' => 'Api', 'action'=>'put']);
$router->addPut('/v1/{path0}/{path1}/{path2}/{path3}', ['controller' => 'Api', 'action'=>'put']);
$router->addPut('/v1/{path0}/{path1}/{path2}/{path3}/{path4}', ['controller' => 'Api', 'action'=>'put']);



$router->handle();

return $router;
