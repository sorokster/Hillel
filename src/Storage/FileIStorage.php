<?php declare(strict_types=1);

namespace Hillel\Project\Storage;

use Hillel\Project\ValueObject\UrlCodeValueObject;

class FileIStorage implements IStorage
{
    public const DEFAULT_FILEPATH = 'data/codes.txt';

    public function __construct(
        public string $filename = self::DEFAULT_FILEPATH
    )
    {
    }

    /**
     * @param string $code
     * @param string $url
     * @return void
     */
    public function addRecord(string $code, string $url): void
    {
        $data = serialize(new UrlCodeValueObject($url, $code));
        file_put_contents($this->filename, $data . PHP_EOL, FILE_APPEND);
    }

    /**
     * @param string $code
     * @return UrlCodeValueObject|null
     */
    public function getRecord(string $code): ?UrlCodeValueObject
    {
        $data = explode(PHP_EOL, file_get_contents($this->filename));
        foreach ($data as $row) {
            if ($row === '') {
                continue;
            }

            /** @var UrlCodeValueObject $item */
            $item = unserialize($row);

            if (!$item instanceof UrlCodeValueObject) {
                continue;
            }

            if ($item->code === $code) {
                return $item;
            }
        }

        return null;
    }
}
