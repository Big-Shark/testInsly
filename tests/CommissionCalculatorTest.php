<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CommissionCalculatorTest extends TestCase
{
    public function testInvoke()
    {
        $calculator = new \InsuranceCalculator\CommissionCalculator();
        $this->assertEquals($calculator(new \InsuranceCalculator\BasePriceResult(10, 100)), new \InsuranceCalculator\CommissionResult(17, 17));
        $this->assertEquals($calculator(new \InsuranceCalculator\BasePriceResult(10, 200)), new \InsuranceCalculator\CommissionResult(17, 34));
    }
}
