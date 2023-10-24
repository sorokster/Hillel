<?php declare(strict_types=1);

/** @var Container $container */

use Hillel\Project\Core\DI\Container;
use Hillel\Project\Core\Exceptions\NotFoundException;
use Hillel\Project\Core\Web\Controllers\ErrorController;
use Hillel\Project\Core\Web\Exceptions\RouteNotFoundException;
use Illuminate\Database\Capsule\Manager;

$container = require_once __DIR__ . '/../src/bootstrap.php';
$routes = require_once __DIR__ . '/../src/routes.php';

$uri = $_SERVER['REQUEST_URI'] ?? '';
$route = strtok(substr($_SERVER['REQUEST_URI'], 1), '?');

try {
    $container->get(Manager::class);

    if (!in_array($route, array_keys($routes))) {
        throw new RouteNotFoundException();
    }

    $handler = $routes[$route];
    $className = array_key_first($handler);
    $controller = $container->get($className);
    $action = $handler[$className];

    $queryString = $_SERVER['QUERY_STRING'] ?? '';
    if (empty($queryString)) {
        call_user_func([$controller, $action]);
    } else {
        $queryParams = explode('=', $queryString);
        $data = call_user_func_array([$controller, $action], [$queryParams[1]]);
    }
} catch (NotFoundException|ReflectionException $e) {
    var_dump($e->getMessage());
} catch (Throwable $e) {
    /** @var ErrorController $errorController */
    $errorController = $container->get(ErrorController::class);
    $errorController->error();
}
