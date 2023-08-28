<?php declare(strict_types=1);

namespace Hillel\Project;

class Calculator
{
    /**
     * @param Request $request
     * @return float|int
     */
    public function calculate(Request $request): float|int
    {
        return $request->getHandler()->calculate($request);
    }
}
