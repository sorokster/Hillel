<?php declare(strict_types=1);

namespace Hillel\Project\Handler;

use Hillel\Project\Request;

class Subtraction extends Calculator
{
    /**
     * @param Request $request
     * @return int|float
     */
    public function calculate(Request $request): int|float
    {
        return $request->getOperand1() - $request->getOperand2();
    }
}
