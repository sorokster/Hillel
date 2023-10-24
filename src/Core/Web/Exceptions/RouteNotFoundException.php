<?php declare(strict_types=1);

namespace Hillel\Project\Core\Web\Exceptions;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

class RouteNotFoundException extends Exception implements NotFoundExceptionInterface
{
    protected $message = 'Route is not found!';
}
