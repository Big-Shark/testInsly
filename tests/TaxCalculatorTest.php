<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class TaxCalculatorTest extends TestCase
{
    public function testInvoke()
    {
        $calculator = new \InsuranceCalculator\TaxCalculator();
        $this->assertEquals($calculator(10, new \InsuranceCalculator\BasePriceResult(10, 100)), new \InsuranceCalculator\TaxResult(10, 10));
        $this->assertEquals($calculator(15, new \InsuranceCalculator\BasePriceResult(10, 100)), new \InsuranceCalculator\TaxResult(15, 15));
    }
}
