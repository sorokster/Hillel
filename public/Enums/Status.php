<?php declare(strict_types=1);

namespace Hillel\Project\Enums;

/**
 * Enum Status
 * @package Hillel\Project\Enums
 */
enum Status
{
    case PARSE;
    case IMPORT;
    case DOWNLOAD;
    case DONE;
    case REAUTHORIZE;

    /** @return string */
    public function getDescription(): string
    {
        return match ($this) {
            Status::PARSE => 'Parsing',
            Status::IMPORT => 'Importing',
            Status::DOWNLOAD => 'Downloading',
            Status::DONE => 'Done',
            Status::REAUTHORIZE => 'Reauthorizing',
        };
    }
}
