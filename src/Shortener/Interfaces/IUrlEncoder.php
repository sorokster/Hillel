<?php declare(strict_types=1);

namespace Hillel\Project\Shortener\Interfaces;

use InvalidArgumentException;

interface IUrlEncoder
{
    /**
     * @param string $url
     * @return string
     * @throws InvalidArgumentException
     */
    public function encode(string $url): string;
}
