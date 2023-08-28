<?php declare(strict_types=1);

use Hillel\Project\Calculator;
use Hillel\Project\Handler\Addition;
use Hillel\Project\Request;

require_once 'vendor/autoload.php';

try {
    $handler = new Addition();
    $request = new Request();
    $request->setOperand1(10.7);
    $request->setOperand2(2.5);
    $request->setHandler($handler);

    $calculator = new Calculator();
    $result = $calculator->calculate($request);

    var_dump($result);
} catch (InvalidArgumentException $e) {
    var_dump($e->getMessage());
}
