<?php declare(strict_types=1);

namespace Hillel\Project\Shortener;

use Hillel\Project\Storage\Storage;
use InvalidArgumentException;

class UrlDecoder implements IUrlDecoder
{
    public function __construct(public Storage $storage)
    {
    }

    /**
     * @param string $code
     * @throws InvalidArgumentException
     * @return string
     */
    public function decode(string $code): string
    {
        if (empty($record = $this->storage->getRecord($code))) {
            throw new InvalidArgumentException('Url is not found');
        }

        return $record->url;
    }
}
