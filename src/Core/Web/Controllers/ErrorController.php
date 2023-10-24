<?php declare(strict_types=1);

namespace Hillel\Project\Core\Web\Controllers;

class ErrorController
{
    protected const DEFAULT_MESSAGE = 'Page is not found';

    /**
     * @param string $message
     * @return void
     */
    public function error(string $message): void
    {
        echo $message ?? self::DEFAULT_MESSAGE;
    }
}
