<?php declare(strict_types=1);

namespace Hillel\Project\Shortener;

use Hillel\Project\Storage\IStorage;
use InvalidArgumentException;

class UrlDecoder implements IUrlDecoder
{
    public function __construct(public IStorage $storage)
    {
    }

    /**
     * @param string $code
     * @return string
     * @throws InvalidArgumentException
     */
    public function decode(string $code): string
    {
        if (empty($record = $this->storage->getRecord($code))) {
            throw new InvalidArgumentException('Url is not found');
        }

        return $record->url;
    }
}
