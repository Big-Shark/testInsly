<?php
declare(strict_types=1);

namespace InsuranceCalculator;

/**
 * Class BasePriceResult
 *
 * @package InsuranceCalculator
 */
class BasePriceResult implements \JsonSerializable
{
    /**
     * @var int
     */
    private $percent;

    /**
     * @var int
     */
    private $value;

    /**
     * BasePriceResult constructor.
     *
     * @param int $percent
     * @param int $value
     */
    public function __construct(int $percent, int $value)
    {
        $this->percent = $percent;
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getPercent() : int
    {
        return $this->percent;
    }

    /**
     * @return int
     */
    public function getValue() : int
    {
        return $this->value;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'percent' => $this->percent,
            'value' => $this->value,
        ];
    }
}
