<?php declare(strict_types=1);

use Hillel\Project\Core\DI\Container;
use Hillel\Project\Shortener\Repositories\FileRepository;
use Hillel\Project\Shortener\UrlShortener;

require 'vendor/autoload.php';

$container = new Container();
$container
    ->add(FileRepository::class, FileRepository::class)
    ->add(UrlShortener::class, function () use ($container): UrlShortener {
        return new UrlShortener($container->get(FileRepository::class));
    });

return $container;
