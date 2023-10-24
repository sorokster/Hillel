<?php declare(strict_types=1);

use Hillel\Project\Core\DI\Container;
use Hillel\Project\Core\ORM\ActiveRecord\DatabaseConnection as ActiveRecordConnection;
use Hillel\Project\Core\Web\Controllers\ErrorController;
use Hillel\Project\Core\Web\Controllers\ShortenerController;
use Hillel\Project\Shortener\Repositories\ActiveRecordRepository;
use Hillel\Project\Shortener\Repositories\FileRepository;
use Hillel\Project\Shortener\UrlShortener;
use Illuminate\Database\Capsule\Manager;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new Container();
$container
    ->add(Manager::class, function () use ($container): ActiveRecordConnection {
        return new ActiveRecordConnection(
            getenv('MYSQL_DATABASE'),
            getenv('MYSQL_USER'),
            getenv('MYSQL_PASSWORD'),
            getenv('MYSQL_PORT'),
        );
    })
    ->add(ActiveRecordRepository::class, ActiveRecordRepository::class)
    ->add(FileRepository::class, FileRepository::class)
    ->add(UrlShortener::class . ActiveRecordRepository::class, function () use ($container): UrlShortener {
        return new UrlShortener($container->get(ActiveRecordRepository::class));
    })
    ->add(UrlShortener::class . FileRepository::class, function () use ($container): UrlShortener {
        return new UrlShortener($container->get(FileRepository::class));
    })
    ->add(ShortenerController::class, function () use ($container): ShortenerController {
        return new ShortenerController($container->get(UrlShortener::class . ActiveRecordRepository::class));
    })
    ->add(ErrorController::class, ErrorController::class);


return $container;
