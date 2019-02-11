<?php
declare(strict_types=1);

namespace InsuranceCalculator;

/**
 * Class CommissionCalculator
 *
 * @package InsuranceCalculator
 */
class CommissionCalculator
{
    /**
     *
     */
    const COMMISSION = 17;

    /**
     * @param  BasePriceResult $basePriceResult
     * @return CommissionResult
     */
    public function __invoke(BasePriceResult $basePriceResult) : CommissionResult
    {
        $value = (int)ceil($basePriceResult->getValue() / 100) * self::COMMISSION;
        return new CommissionResult(self::COMMISSION, $value);
    }
}
