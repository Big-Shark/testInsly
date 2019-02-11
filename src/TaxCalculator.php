<?php
declare(strict_types=1);

namespace InsuranceCalculator;

/**
 * Class TaxCalculator
 *
 * @package InsuranceCalculator
 */
class TaxCalculator
{
    /**
     * @param  int             $tax
     * @param  BasePriceResult $basePriceResult
     * @return TaxResult
     */
    public function __invoke(int $tax, BasePriceResult $basePriceResult) : TaxResult
    {
        $value = (int)ceil($basePriceResult->getValue() / 100) * $tax;
        return new TaxResult($tax, $value);
    }
}
