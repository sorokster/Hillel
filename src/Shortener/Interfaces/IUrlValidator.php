<?php declare(strict_types=1);

namespace Hillel\Project\Shortener\Interfaces;

interface IUrlValidator
{
    public function validate(string $url): bool;
}
