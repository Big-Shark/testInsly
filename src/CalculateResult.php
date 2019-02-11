<?php
declare(strict_types=1);

namespace InsuranceCalculator;

/**
 * Class CalculateResult
 *
 * @package InsuranceCalculator
 */
class CalculateResult implements \JsonSerializable
{
    /**
     * @var int
     */
    private $value;
    /**
     * @var BasePriceResult
     */
    private $basePrice;
    /**
     * @var CommissionResult
     */
    private $commission;
    /**
     * @var TaxResult
     */
    private $tax;
    /**
     * @var int
     */
    private $total;
    /**
     * @var iterable
     */
    private $instalments;

    /**
     * CalculateResult constructor.
     *
     * @param int              $value
     * @param BasePriceResult  $basePrice
     * @param CommissionResult $commission
     * @param TaxResult        $tax
     * @param int              $total
     * @param iterable         $instalments
     */
    public function __construct(
        int $value,
        BasePriceResult $basePrice,
        CommissionResult $commission,
        TaxResult $tax,
        int $total,
        iterable $instalments
    ) {
        $this->value = $value;
        $this->basePrice = $basePrice;
        $this->commission = $commission;
        $this->tax = $tax;
        $this->total = $total;
        $this->instalments = $instalments;
    }

    /**
     * @return int
     */
    public function getValue() : int
    {
        return $this->value;
    }

    /**
     * @return BasePriceResult
     */
    public function getBasePrice() : BasePriceResult
    {
        return $this->basePrice;
    }

    /**
     * @return CommissionResult
     */
    public function getCommission() : CommissionResult
    {
        return $this->commission;
    }

    /**
     * @return TaxResult
     */
    public function getTax() : TaxResult
    {
        return $this->tax;
    }

    /**
     * @return int
     */
    public function getTotal() : int
    {
        return $this->total;
    }

    /**
     * @return \Generator
     */
    public function getInstalments() : \Generator
    {
        return $this->instalments;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'value' => $this->value,
            'basePrice' => $this->basePrice,
            'commission' => $this->commission,
            'tax' => $this->tax,
            'total' => $this->total,
            'instalments' => iterator_to_array($this->instalments),
        ];
    }
}
