<?php declare(strict_types=1);

use Hillel\Project\Core\DI\Container;
use Hillel\Project\Core\ORM\ActiveRecord\DatabaseConnection as ActiveRecordConnection;
use Hillel\Project\Shortener\Repositories\ActiveRecordRepository;
use Hillel\Project\Shortener\Repositories\FileRepository;
use Hillel\Project\Shortener\UrlShortener;
use Illuminate\Database\Capsule\Manager;

require 'vendor/autoload.php';

$container = new Container();
$container
    ->add(Manager::class, function () use ($container): ActiveRecordConnection {
        return new ActiveRecordConnection(
            'hillel',
            'hillel',
            'hillel!23',
            '33060',
            '127.0.0.1'
        );
    })
    ->add(ActiveRecordRepository::class, ActiveRecordRepository::class)
    ->add(FileRepository::class, FileRepository::class)
    ->add(UrlShortener::class, function () use ($container): UrlShortener {
        return new UrlShortener($container->get(ActiveRecordRepository::class));
    });
//    ->add(UrlShortener::class, function () use ($container): UrlShortener {
//        return new UrlShortener($container->get(FileRepository::class));
//    });


return $container;
