<?php declare(strict_types=1);

namespace Hillel\Project\Enum;

enum Operator: string
{
    case ADDITION = '+';
    case SUBTRACTION = '-';
    case MULTIPLICATION = '*';
    case DIVISION = '/';
}
