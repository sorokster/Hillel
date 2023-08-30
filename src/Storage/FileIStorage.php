<?php declare(strict_types=1);

namespace Hillel\Project\Storage;

use Hillel\Project\DTO\UrlCodeDTO;

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
        $data = serialize(new UrlCodeDTO($url, $code));
        file_put_contents($this->filename, $data . PHP_EOL, FILE_APPEND);
    }

    /**
     * @param string $code
     * @return UrlCodeDTO|null
     */
    public function getRecord(string $code): ?UrlCodeDTO
    {
        $data = explode(PHP_EOL, file_get_contents($this->filename));
        foreach ($data as $row) {
            if ($row === '') {
                continue;
            }

            /** @var UrlCodeDTO $item */
            $item = unserialize($row);

            if (!$item instanceof UrlCodeDTO) {
                continue;
            }

            if ($item->code === $code) {
                return $item;
            }
        }

        return null;
    }
}
