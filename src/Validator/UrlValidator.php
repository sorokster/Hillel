<?php declare(strict_types=1);

namespace Hillel\Project\Validator;

use InvalidArgumentException;

class UrlValidator implements IUrlValidator
{
    public function __construct(public string $url)
    {
    }

    /** @return bool */
    public function validate(): bool
    {
        if (filter_var($this->url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException('String is not a url.');
        }

        return true;
    }
}
