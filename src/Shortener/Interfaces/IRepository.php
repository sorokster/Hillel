<?php declare(strict_types=1);

namespace Hillel\Project\Shortener\Interfaces;

use Hillel\Project\Shortener\ValueObjects\UrlCodeValueObject;

interface IRepository
{
    /**
     * @param string $code
     * @param string $url
     * @return void
     */
    public function addRecord(string $code, string $url): void;

    /**
     * @param string $code
     * @return UrlCodeValueObject|null
     */
    public function getRecord(string $code): ?UrlCodeValueObject;
}
