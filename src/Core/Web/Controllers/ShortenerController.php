<?php declare(strict_types=1);

namespace Hillel\Project\Core\Web\Controllers;

use Hillel\Project\Shortener\Interfaces\IUrlDecoder;
use Hillel\Project\Shortener\Interfaces\IUrlEncoder;

class ShortenerController
{
    /**
     * @param IUrlDecoder|IUrlEncoder $shortener
     */
    public function __construct(protected IUrlDecoder|IUrlEncoder $shortener)
    {
    }

    /**
     * @param string $url
     * @return string
     */
    public function action(string $url): string
    {
        return $this->shortener->encode($url);
    }
}
