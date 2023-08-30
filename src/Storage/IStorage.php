<?php declare(strict_types=1);

namespace Hillel\Project\Storage;

use Hillel\Project\DTO\UrlCodeDTO;

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
     * @return UrlCodeDTO|null
     */
    public function getRecord(string $code): ?UrlCodeDTO;
}
