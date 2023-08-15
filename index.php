<?php declare(strict_types=1);

use Hillel\Project\Enums\Status;

require_once 'vendor/autoload.php';

var_dump(Status::PARSE->getDescription());
