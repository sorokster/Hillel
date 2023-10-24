<?php declare(strict_types=1);

namespace Hillel\Project\Core\Web\Controllers;

class ErrorController
{
    /** @return void */
    public function error(): void
    {
        echo 'Page is not found';
    }
}
