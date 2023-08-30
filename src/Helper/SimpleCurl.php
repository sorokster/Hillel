<?php declare(strict_types=1);

namespace Hillel\Project\Helper;

use CurlHandle;
use Hillel\Project\Validator\UrlValidator;

class SimpleCurl
{
    protected false|CurlHandle $curl;

    public function __construct(public string $url)
    {
        if ($this->validateUrl()) {
            $this->init();
        }
    }

    /** @return void */
    public function init(): void
    {
        $this->curl = curl_init($this->url);
        curl_setopt($this->curl, CURLOPT_URL, $this->url);
    }

    /** @return string */
    public function execute(): string
    {
        return (string)curl_exec($this->curl);
    }

    public function getInfo(int $option)
    {
        return curl_getinfo($this->curl, $option);
    }


    /** @return void */
    public function close(): void
    {
        curl_close($this->curl);
    }

    /**
     * @param int $name
     * @param string|bool|int $value
     * @return SimpleCurl
     */
    public function setOption(int $name, string|bool|int $value): SimpleCurl
    {
        curl_setopt($this->curl, $name, $value);
        return $this;
    }

    /** @return bool */
    protected function validateUrl(): bool
    {
        $urlValidator = new UrlValidator();
        return $urlValidator->validate($this->url);
    }
}

