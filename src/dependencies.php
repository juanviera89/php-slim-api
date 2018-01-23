<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// PDO
$container['PDOmySql'] = function ($c) {
    $settings = $c->get('settings')['PDOmySql'];
    $mySql;
    try {
        
        $mySql = new dbConnection($settings['host'],$settings['db'],$settings['user'],$settings['pass'],$settings['charset']);
    } catch (PDOException $e){
        echo $e->getMessage();
    }
    
    return $mySql;
};
