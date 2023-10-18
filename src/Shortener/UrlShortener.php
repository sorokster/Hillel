<?php declare(strict_types=1);

namespace Hillel\Project\Shortener;

use Hillel\Project\Core\Helpers\SimpleCurl;
use Hillel\Project\Shortener\Interfaces\IRepository;
use Hillel\Project\Shortener\Interfaces\IUrlDecoder;
use Hillel\Project\Shortener\Interfaces\IUrlEncoder;
use Hillel\Project\Shortener\Validators\UrlValidator;
use InvalidArgumentException;

class UrlShortener implements IUrlEncoder, IUrlDecoder
{
    private string $salt = 'encode';
    protected int $maxLength = 10;

    public function __construct(public IRepository $storage)
    {
    }

    /**
     * @param string $url
     * @throws InvalidArgumentException
     * @return string
     */
    public function encode(string $url): string
    {
        if (!$this->validateUrl($url)) {
            throw new InvalidArgumentException('Website is not exist');
        }

        $code = substr(hash_hmac('sha256', $url, $this->salt), 0, $this->maxLength);

        if (empty($this->storage->getRecord($code))) {
            $this->storage->addRecord($code, $url);
        }

        return $code;
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

        return $record->getUrl();
    }

    /**
     * @param string $url
     * @return bool
     */
    protected function validateUrl(string $url): bool
    {
        $curl = new SimpleCurl($url, new UrlValidator());
        $curl
            ->setOption(CURLOPT_RETURNTRANSFER, 1)
            ->setOption(CURLOPT_FOLLOWLOCATION, 1);
        $curl->execute();
        $httpCode = $curl->getInfo(CURLINFO_HTTP_CODE);
        $curl->close();

        return $httpCode === 200;
    }
}
