<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 1:56 PM
 */

try {
    include __DIR__ . "/../TheFramework/PDO/DbConnection.php";
    include __DIR__ . "/../TheFramework/PDO/DbTable.php";
    include __DIR__ . "/../TheFramework/Templating/TemplateMaker.php";
    include __DIR__ . "/../src/routes.php";

    $userTable = new \TheFramework\PDO\DbTable($pdo, 'user', 'id');
    $messageTable = new \TheFramework\PDO\DbTable($pdo, 'message', 'id');

    $controllerName = $_GET['controller'] ?? 'home';
    $action = $_GET['action'] ?? 'index';

    $route = strtok($_SERVER['REQUEST_URI'], '?');

    if ($route == strtolower($route)) {
        $currentRoute = $routes[$route];

        include __DIR__ . $currentRoute['file_path'];

        $action = (string)$currentRoute['action'];
        $page = (new $currentRoute['class_path']())->$action();
    } else {
        http_response_code(301);
        header('location: index.php?controller=' . strtolower($controllerName) .
            '&action=' . strtolower($action));
    }

    $title = $page['title'];
    $body = $page['body'];

} catch (\PDOException $exception) {
    $title = 'Error occurred';
    $body = 'Database error : ' . $exception->getMessage();
}

if (array_key_exists('content_type', $page)) {
    switch ($page['content_type']) {
        case 'application/xml':
        case 'application/json';
            header('Content-Type: ' . $page['content_type']);
            echo $page['body'];
            break;
        default:
            include __DIR__ . '/../templates/layout.php';
    }
} else {
    include __DIR__ . '/../templates/layout.php';
}

