<?php declare(strict_types=1);

namespace Hillel\Project;

use Hillel\Project\Enum\Operator;
use Hillel\Project\Handler\Addition as AdditionHandler;
use Hillel\Project\Handler\Division as DivisionHandler;
use Hillel\Project\Handler\Multiplication as MultiplicationHandler;
use Hillel\Project\Handler\Subtraction as SubtractionHandler;

class Calculator
{
    /**
     * @param Request $request
     * @return float|int
     */
    public function calculate(Request $request): float|int
    {
        $handler = match ($request->getOperator()) {
            Operator::ADDITION => new AdditionHandler(),
            Operator::SUBTRACTION => new SubtractionHandler(),
            Operator::MULTIPLICATION => new MultiplicationHandler(),
            Operator::DIVISION => new DivisionHandler(),
        };

        return $handler->calculate($request);
    }
}
