<?php declare(strict_types=1);

namespace Hillel\Project\Core\Web\Controllers;

use Hillel\Project\Shortener\Interfaces\IUrlDecoder;
use Hillel\Project\Shortener\Interfaces\IUrlEncoder;

class ShortenerController
{
    /**
     * @param IUrlDecoder|IUrlEncoder $shortener
     */
    public function __construct(protected IUrlDecoder|IUrlEncoder $shortener)
    {
    }

    public function index(): void
    {
        echo '<p>Encode Url</p><form method="GET" action="shortener/encode"><input type="text" name="url"><input type="submit" value="Encode"></form>';
        echo '<p>Decode Url</p><form method="GET" action="shortener/decode"><input type="text" name="code"><input type="submit" value="Decode"></form>';
    }

    /**
     * @param string $url
     * @return string
     */
    public function encode(string $url): string
    {
        return $this->shortener->encode($url);
    }

    /**
     * @param string $code
     * @return string
     */
    public function decode(string $code): string
    {
        return $this->shortener->decode($code);
    }
}
