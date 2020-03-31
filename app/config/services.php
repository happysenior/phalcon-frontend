<?php
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
//use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Crypt;
use Phalcon\Http\Request;
use Phalcon\Http\Response\Cookies;

/**
 * The FactoryDefault Dependency Injector automatically registers
 * the services that provide a full stack framework.
 */

$di = new FactoryDefault();


/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

$di->set('router', function(){
    require __DIR__.'/routes.php';
    return $router;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($this->getConfig()->application->viewsDir);
    $view->registerEngines(['.phtml' => PhpEngine::class]);
    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
//$di->setShared('db', function () {
//    $config = $this->getConfig();
//
//    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
//    $params = [
//        'host'     => $config->database->host,
//        'username' => $config->database->username,
//        'password' => $config->database->password,
//        'dbname'   => $config->database->dbname,
//        'charset'  => $config->database->charset
//    ];
//
//    if ($config->database->adapter == 'Postgresql') {
//        unset($params['charset']);
//    }
//
//    $connection = new $class($params);
//
//    return $connection;
//});

$di->set('timeZone', function () use ($config) {
    return new DateTimeZone($config->application->timeZone);
});

$di->set('router', function(){
    require __DIR__.'/routes.php';
    return $router;
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
//$di->setShared('modelsMetadata', function () {
//    return new MetaDataAdapter();
//});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();
    return $session;
});

$di->set(
    'cookies',
    function () {
        $cookies = new Cookies();
        $cookies->useEncryption(false);
        return $cookies;
    }
);

$di->set(
    'crypt',
    function () {
        $crypt = new Crypt();
        /* Set the cipher algorithm. */
        $crypt->setCipher('aes-256-ctr');
        /* Setting the encryption key. */
        $key = "z9OiK4a<_!3zWX0y}S*D?y3Y!c9Fmo)r&kN>lE66";
        $crypt->setKey($key);
        return $crypt;
    }
);
