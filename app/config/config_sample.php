<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config(
    [
        'api' => [
            'apiUrl' => 'https://api.pianini.app/v1'
        ],
        'apiAuth' => [
            'apiKey' => 'AamqWQHk5figXT5B837Xhnwjvo5cqTr1yXoP3KKy7DgU2dvCjvTT733U87HcubxV244YLESX3L6XV7T',
            'apiSecret' => 'nfLK1SqfCBXp0rE1FMPnA6OQeclMtAtwKVOwH6LAQs3YtnqRjaD9X03tBGLydUUSl9YxsYe05',
        ],
//        'database' => [
//            'adapter' => 'Mysql',
//            'host' => 'localhost',
//            'username' => 'root',
//            'password' => '',
//            'dbname' => 'test',
//            'charset' => 'utf8',
//        ],
        'application' => [
            'appDir' => APP_PATH . '/',
            'controllersDir' => APP_PATH . '/controllers/',
            'modelsDir' => APP_PATH . '/models/',
            'migrationsDir' => APP_PATH . '/migrations/',
            'viewsDir' => APP_PATH . '/views/',
            'pluginsDir' => APP_PATH . '/plugins/',
            'libraryDir' => APP_PATH . '/library/',
            'cacheDir' => BASE_PATH . '/cache/',
            'timeZone' => 'UTC',

            // This allows the baseUri to be understand project paths that are not in the root directory
            // of the webpspace.  This will break if the public/index.php entry point is moved or
            // possibly if the web server rewrite rules are changed. This can also be set to a static path.
            //'baseUri' => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
            'baseUri' => '/'
        ],

        'translation' => [
            'messagesDir' => APP_PATH . '/messages/',
            'translationCsv' => 'translations',
            //gDriveTranslationUrl = https://docs.google.com/spreadsheets/d/***********************************/export?format=csv
        ],
        'languages' => [
            'DE' => 'Deutsch',
            'EN' => 'English',
        ],
    ]
);
