<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CalculateTest extends TestCase
{
    public function testInvoke(): void
    {
        $calculator = new \InsuranceCalculator\Calculator(
            (new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('10:00'))),
            (new \InsuranceCalculator\CommissionCalculator()),
            (new \InsuranceCalculator\TaxCalculator())
        );
        $result = $calculator(1000000, 10, 2);

        $this->assertInstanceOf(\InsuranceCalculator\CalculateResult::class, $result);
        $this->assertEquals($result->getValue(), 1000000);
        $this->assertEquals($result->getBasePrice()->getValue(), 110000);
        $this->assertEquals($result->getCommission()->getValue(), 18700);
        $this->assertEquals($result->getTax()->getValue(), 11000);
        $this->assertEquals($result->getBasePrice()->getPercent(), 11);
        $this->assertEquals($result->getCommission()->getPercent(), 17);
        $this->assertEquals($result->getTax()->getPercent(), 10);
        $this->assertEquals($result->getTotal(), 139700);

        $this->assertInstanceOf(Generator::class, $result->getInstalments());

        $instalments = iterator_to_array($result->getInstalments());
        $this->assertEquals(count($instalments), 2);

        $this->assertEquals($instalments[0]->getBasePrice(), 55000);
        $this->assertEquals($instalments[0]->getCommission(), 9350);
        $this->assertEquals($instalments[0]->getTax(), 5500);
        $this->assertEquals($instalments[0]->getTotal(), 69850);

        $this->assertEquals($instalments[1]->getBasePrice(), 55000);
        $this->assertEquals($instalments[1]->getCommission(), 9350);
        $this->assertEquals($instalments[1]->getTax(), 5500);
        $this->assertEquals($instalments[1]->getTotal(), 69850);
    }

    public function testNotDividingPrice(): void
    {
        $calculator = new \InsuranceCalculator\Calculator(
            (new \InsuranceCalculator\BasePriceCalculator(new DateTimeImmutable('10:00'))),
            (new \InsuranceCalculator\CommissionCalculator()),
            (new \InsuranceCalculator\TaxCalculator())
        );

        $result = $calculator(1000000, 10, 3);

        $this->assertInstanceOf(\InsuranceCalculator\CalculateResult::class, $result);
        $this->assertEquals($result->getValue(), 1000000);
        $this->assertEquals($result->getBasePrice()->getValue(), 110000);
        $this->assertEquals($result->getCommission()->getValue(), 18700);
        $this->assertEquals($result->getTax()->getValue(), 11000);
        $this->assertEquals($result->getBasePrice()->getPercent(), 11);
        $this->assertEquals($result->getCommission()->getPercent(), 17);
        $this->assertEquals($result->getTax()->getPercent(), 10);
        $this->assertEquals($result->getTotal(), 139700);

        $this->assertInstanceOf(Generator::class, $result->getInstalments());

        $instalments = iterator_to_array($result->getInstalments());
        $this->assertEquals(count($instalments), 3);

        $this->assertEquals($instalments[0]->getBasePrice(), 36667);
        $this->assertEquals($instalments[0]->getCommission(), 6234);
        $this->assertEquals($instalments[0]->getTax(), 3667);
        $this->assertEquals($instalments[0]->getTotal(), 46567);

        $this->assertEquals($instalments[1]->getBasePrice(), 36667);
        $this->assertEquals($instalments[1]->getCommission(), 6233);
        $this->assertEquals($instalments[1]->getTax(), 3667);
        $this->assertEquals($instalments[1]->getTotal(), 46567);

        $this->assertEquals($instalments[2]->getBasePrice(), 36666);
        $this->assertEquals($instalments[2]->getCommission(), 6233);
        $this->assertEquals($instalments[2]->getTax(), 3666);
        $this->assertEquals($instalments[2]->getTotal(), 46566);
    }
}
