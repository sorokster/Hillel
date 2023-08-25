<?php declare(strict_types=1);

namespace Hillel\Project;

use Hillel\Project\Enum\Operator;

class Request
{
    private int|float $operand1;
    private int|float $operand2;
    private Operator $operator;

    /** @return int|float */
    public function getOperand1(): int|float
    {
        return $this->operand1;
    }

    /**
     * @param int|float $operand1
     * @return void
     */
    public function setOperand1(int|float $operand1): void
    {
        $this->operand1 = $operand1;
    }

    /** @return int|float */
    public function getOperand2(): int|float
    {
        return $this->operand2;
    }

    /**
     * @param int|float $operand2
     * @return void
     */
    public function setOperand2(int|float $operand2): void
    {
        $this->operand2 = $operand2;
    }

    /** @return Operator */
    public function getOperator(): Operator
    {
        return $this->operator;
    }

    /**
     * @param Operator $operator
     * @return void
     */
    public function setOperator(Operator $operator): void
    {
        $this->operator = $operator;
    }
}
