<?php declare(strict_types=1);

namespace Hillel\Project\DTO;

class UrlCodeDTO
{
    public function __construct(public string $url, public string $code)
    {
    }
}
