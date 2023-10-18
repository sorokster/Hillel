<?php declare(strict_types=1);

use Hillel\Project\Core\DI\Container;
use Hillel\Project\Core\Exceptions\NotFoundException;
use Hillel\Project\Shortener\UrlShortener;

/** @var Container $container */
$container = require_once __DIR__ . '/../src/bootstrap.php';

try {
    /** @var UrlShortener $shortener */
    $shortener = $container->get(UrlShortener::class);
    $shortener->encode('https://www.google.com');
} catch (NotFoundException|ReflectionException $e) {
    var_dump($e->getMessage());
}
