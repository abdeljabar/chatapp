<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 9:01 PM
 */

$routes = [];

$routes['/'] = [
    'action' => 'index',
    'controllerName' => 'home',
    'class_path' => '\App\Controller\HomeController',
    'file_path' => '/../src/Controller/HomeController.php',
];

$routes['/login'] = [
    'action' => 'login',
    'controllerName' => 'security',
    'class_path' => '\App\Controller\SecurityController',
    'file_path' => '/../src/Controller/SecurityController.php',
];

$routes['/messages/archive'] = [
    'action' => 'archive',
    'controllerName' => 'message',
    'class_path' => '\App\Controller\MessageController',
    'file_path' => '/../src/Controller/MessageController.php',
];

$routes['/messages/list'] = [
    'action' => 'archive',
    'controllerName' => 'message',
    'class_path' => '\App\Controller\MessageController',
    'file_path' => '/../src/Controller/MessageController.php',
];

$routes['/api'] = [
    'action' => 'index',
    'controllerName' => 'home',
    'class_path' => '\App\Controller\Api\HomeController',
    'file_path' => '/../src/Controller/Api/HomeController.php',
];

$routes['/api/contacts'] = [
    'action' => 'list',
    'controllerName' => 'contact',
    'class_path' => '\App\Controller\Api\ContactController',
    'file_path' => '/../src/Controller/Api/ContactController.php',
];

$routes['/api/messages'] = [
    'action' => 'list',
    'controllerName' => 'message',
    'class_path' => '\App\Controller\Api\MessageController',
    'file_path' => '/../src/Controller/Api/MessageController.php',
];

$routes['/api/messages/send'] = [
    'action' => 'send',
    'controllerName' => 'message',
    'class_path' => '\App\Controller\Api\MessageController',
    'file_path' => '/../src/Controller/Api/MessageController.php',
];

$routes['/api/messages/checknew'] = [
    'action' => 'checknew',
    'controllerName' => 'message',
    'class_path' => '\App\Controller\Api\MessageController',
    'file_path' => '/../src/Controller/Api/MessageController.php',
];

$routes['/install'] = [
    'action' => 'install',
    'controllerName' => 'installer',
    'class_path' => '\App\Controller\InstallerController',
    'file_path' => '/../src/Controller/InstallerController.php',
];