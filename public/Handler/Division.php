<?php declare(strict_types=1);

namespace Hillel\Project\Handler;

use Hillel\Project\Request;
use InvalidArgumentException;

class Division implements ICalculator
{
    /**
     * @param Request $request
     * @return int|float
     */
    public function calculate(Request $request): int|float
    {
        if ($request->getOperand2() === 0) {
            throw new InvalidArgumentException('ERROR! Division by zero');
        }

        return $request->getOperand1() / $request->getOperand2();
    }
}
