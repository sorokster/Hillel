<?php declare(strict_types=1);

namespace Hillel\Project\Shortener\ValueObjects;

class UrlCodeValueObject
{
    public function __construct(public string $url, public string $code)
    {
    }

    /** @return string */
    public function getUrl(): string
    {
        return $this->url;
    }

    /** @return string */
    public function getCode(): string
    {
        return $this->code;
    }
}
