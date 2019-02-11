<?php
declare(strict_types=1);

namespace InsuranceCalculator;

/**
 * Class Calculator
 *
 * @package InsuranceCalculator
 */
class Calculator
{
    /**
     * @var BasePriceCalculator
     */
    private $basePriceCalculator;
    /**
     * @var CommissionCalculator
     */
    private $commissionCalculator;
    /**
     * @var TaxCalculator
     */
    private $taxCalculator;

    /**
     * Calculator constructor.
     *
     * @param BasePriceCalculator  $basePriceCalculator
     * @param CommissionCalculator $commissionCalculator
     * @param TaxCalculator        $taxCalculator
     */
    public function __construct(
        BasePriceCalculator $basePriceCalculator,
        CommissionCalculator $commissionCalculator,
        TaxCalculator $taxCalculator
    ) {
        $this->basePriceCalculator = $basePriceCalculator;
        $this->commissionCalculator = $commissionCalculator;
        $this->taxCalculator = $taxCalculator;
    }

    /**
     * @param  int $value
     * @param  int $tax
     * @param  int $instalments
     * @return CalculateResult
     */
    public function __invoke(int $value, int $tax, int $instalments) : CalculateResult
    {
        $basePrice = ($this->basePriceCalculator)($value);
        $commission = ($this->commissionCalculator)($basePrice);
        $tax = ($this->taxCalculator)($tax, $basePrice);
        $total = $basePrice->getValue() + $commission->getValue() + $tax->getValue();

        $instalments = $this->generateInstalments($instalments, $basePrice, $commission, $tax, $total);
        return new CalculateResult($value, $basePrice, $commission, $tax, $total, $instalments);
    }

    /**
     * @param  int              $instalments
     * @param  BasePriceResult  $basePrice
     * @param  CommissionResult $commission
     * @param  TaxResult        $tax
     * @param  int              $total
     * @return \Generator
     */
    private function generateInstalments(
        int $instalments,
        BasePriceResult $basePrice,
        CommissionResult $commission,
        TaxResult $tax,
        int $total
    ) : \Generator {
        $basePriceMod = $basePrice->getValue() % $instalments;
        $commissionMod = $commission->getValue() % $instalments;
        $taxMod = $tax->getValue() % $instalments;
        $totalMod = $total % $instalments;

        $basePrice = (int) floor($basePrice->getValue() / $instalments);
        $commission =(int) floor($commission->getValue()/$instalments);
        $tax = (int)floor($tax->getValue()/$instalments);
        $total = (int) floor($total/$instalments);

        for ($i = 0; $i < $instalments; $i++) {
            yield $i => (new Instalment(
                $basePrice + (int)($basePriceMod > 0),
                $commission + (int)($commissionMod > 0),
                $tax + (int)($taxMod > 0),
                $total + (int)($totalMod > 0)
            ));

            $basePriceMod--;
            $commissionMod--;
            $taxMod--;
            $totalMod--;
        }
    }
}
