<?php declare(strict_types=1);

namespace Hillel\Project\Handler;

use Hillel\Project\Request;

abstract class Calculator
{
    /**
     * @param Request $request
     * @return int|float
     */
    abstract public function calculate(Request $request): int|float;
}
