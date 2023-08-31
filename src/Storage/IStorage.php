<?php declare(strict_types=1);

namespace Hillel\Project\Storage;

use Hillel\Project\ValueObject\UrlCodeValueObject;

interface IStorage
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
