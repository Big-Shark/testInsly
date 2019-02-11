<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class BasePriceCalculatorTest extends TestCase
{
    public function testInvoke()
    {
        $calculator = new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('11:00'));
        $this->assertEquals($calculator(100), new \InsuranceCalculator\BasePriceResult(11, 11));

        $calculator = new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('15:00'));
        $this->assertEquals($calculator(100), new \InsuranceCalculator\BasePriceResult(11, 11));

        $calculator = new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('15:01'));
        $this->assertEquals($calculator(100), new \InsuranceCalculator\BasePriceResult(11, 11));

        $calculator = new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('20:00'));
        $this->assertEquals($calculator(100), new \InsuranceCalculator\BasePriceResult(11, 11));

        $calculator = new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('20:01'));
        $this->assertEquals($calculator(100), new \InsuranceCalculator\BasePriceResult(11, 11));

        $calculator = new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('friday'));
        $this->assertEquals($calculator(100), new \InsuranceCalculator\BasePriceResult(11, 11));

        $calculator = new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('friday 11:00'));
        $this->assertEquals($calculator(100), new \InsuranceCalculator\BasePriceResult(11, 11));

        $calculator = new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('friday 15:00'));
        $this->assertEquals($calculator(100), new \InsuranceCalculator\BasePriceResult(13, 13));

        $calculator = new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('friday 15:01'));
        $this->assertEquals($calculator(100), new \InsuranceCalculator\BasePriceResult(13, 13));

        $calculator = new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('friday 20:00'));
        $this->assertEquals($calculator(100), new \InsuranceCalculator\BasePriceResult(13, 13));

        $calculator = new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('friday 20:01'));
        $this->assertEquals($calculator(100), new \InsuranceCalculator\BasePriceResult(11, 11));
    }
}
