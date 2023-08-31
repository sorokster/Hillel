<?php declare(strict_types=1);

namespace Hillel\Project\ValueObject;

class UrlCodeValueObject
{
    public function __construct(public string $url, public string $code)
    {
    }
}
