<?php declare(strict_types=1);

namespace Hillel\Project\Shortener;

use Hillel\Project\Helper\SimpleCurl;
use Hillel\Project\Storage\IStorage;
use InvalidArgumentException;

class UrlEncoder implements IUrlEncoder
{
    private string $salt = 'encode';
    protected int $maxLength = 10;

    public function __construct(public IStorage $storage)
    {
    }

    /**
     * @param string $url
     * @return string
     * @throws InvalidArgumentException
     */
    public function encode(string $url): string
    {
        if (!$this->validateUrl($url)) {
            throw new InvalidArgumentException('Website is not exist');
        }

        $fullCode = substr(hash_hmac('sha256', $url, $this->salt), $this->maxLength);
        $code = substr($fullCode, 0, 10);

        if (empty($this->storage->getRecord($code))) {
            $this->storage->addRecord($code, $url);
        }

        return $code;
    }

    /**
     * @param string $url
     * @return bool
     */
    protected function validateUrl(string $url): bool
    {
        $curl = new SimpleCurl($url);
        $curl
            ->setOption(CURLOPT_RETURNTRANSFER, 1)
            ->setOption(CURLOPT_FOLLOWLOCATION, 1);
        $curl->execute();
        $httpCode = $curl->getInfo(CURLINFO_HTTP_CODE);
        $curl->close();

        return $httpCode === 200;
    }
}
