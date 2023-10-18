<?php declare(strict_types=1);

namespace Hillel\Project\Shortener\Interfaces;

use InvalidArgumentException;

interface IUrlDecoder
{
    /**
     * @param string $code
     * @return string
     * @throws InvalidArgumentException
     */
    public function decode(string $code): string;
}
