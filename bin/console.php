<?php declare(strict_types=1);

use Hillel\Project\Core\Command\UrlEncoderCommand;
use Hillel\Project\Core\Command\UrlDecoderCommand;
use Symfony\Component\Console\Application;

require 'vendor/autoload.php';

try {
    $application = new Application();
    $application->add(new UrlEncoderCommand());
    $application->add(new UrlDecoderCommand());
    $application->run();
} catch (Exception $e) {
    var_dump($e->getMessage());
}
