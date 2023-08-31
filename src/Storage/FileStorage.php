<?php declare(strict_types=1);

namespace Hillel\Project\Storage;

use Hillel\Project\ValueObject\UrlCodeValueObject;

class FileStorage implements IStorage
{
    public const DEFAULT_DIRECTORY = 'data';
    public const DEFAULT_FILEPATH = 'codes.txt';

    protected string $filepath;

    public function __construct(
        public string $directory = self::DEFAULT_DIRECTORY,
        public string $filename = self::DEFAULT_FILEPATH
    )
    {
        $this->filepath = sprintf('%s/%s', $this->directory, $this->filename);
    }

    /**
     * @param string $code
     * @param string $url
     * @return void
     */
    public function addRecord(string $code, string $url): void
    {
        $data = serialize(new UrlCodeValueObject($url, $code));

        file_put_contents(
            $this->filepath,
            $data . PHP_EOL,
            file_exists($this->filepath) ? FILE_APPEND : FILE_USE_INCLUDE_PATH
        );
    }

    /**
     * @param string $code
     * @return UrlCodeValueObject|null
     */
    public function getRecord(string $code): ?UrlCodeValueObject
    {
        if (!file_exists($this->filepath)) {
            return null;
        }

        $data = explode(PHP_EOL, file_get_contents($this->filepath) ?? '');
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