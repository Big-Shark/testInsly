<?php
declare(strict_types=1);

namespace InsuranceCalculator;

/**
 * Class Instalment
 *
 * @package InsuranceCalculator
 */
class Instalment implements \JsonSerializable
{
    /**
     * @var int
     */
    private $basePrice;
    /**
     * @var int
     */
    private $commission;
    /**
     * @var int
     */
    private $tax;
    /**
     * @var int
     */
    private $total;

    /**
     * Instalment constructor.
     *
     * @param int $basePrice
     * @param int $commission
     * @param int $tax
     * @param int $total
     */
    public function __construct(int $basePrice, int $commission, int $tax, int $total)
    {
        $this->basePrice = $basePrice;
        $this->commission = $commission;
        $this->tax = $tax;
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getBasePrice() : int
    {
        return $this->basePrice;
    }

    /**
     * @return int
     */
    public function getCommission() : int
    {
        return $this->commission;
    }

    /**
     * @return int
     */
    public function getTax() : int
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
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'basePrice' => $this->basePrice,
            'commission' => $this->commission,
            'tax' => $this->tax,
            'total' => $this->total,
        ];
    }
}
