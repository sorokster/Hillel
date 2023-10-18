<?php declare(strict_types = 1);

namespace Hillel\Project\Core\Exceptions;

use Psr\Container\NotFoundExceptionInterface;
use Exception;

class NotFoundException extends Exception implements NotFoundExceptionInterface
{
}
