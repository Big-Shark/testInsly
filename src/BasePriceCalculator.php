<?php
declare(strict_types=1);

namespace InsuranceCalculator;

/**
 * Class BasePriceCalculator
 *
 * @package InsuranceCalculator
 */
class BasePriceCalculator
{
    /**
     * @var \DateTimeImmutable
     */
    private $userTime;

    /**
     * BasePriceCalculator constructor.
     *
     * @param \DateTimeImmutable $userTime
     */
    public function __construct(\DateTimeImmutable $userTime)
    {
        $this->userTime = $userTime;
    }

    /**
     * @return int
     */
    private function getPercent() : int
    {
        //Base price of policy is 11% from entered car value, except every Friday 15-20
        //o’clock (user time) when it is 13%
        $day = (int)$this->userTime->format('N');
        $time = (int)$this->userTime->format('Hi');
        if ($day === 5 && $time >= 1500 && $time <= 2000) {
            return 13;
        }

        return 11;
    }

    /**
     * @param  int $value
     * @return BasePriceResult
     */
    public function __invoke(int $value) : BasePriceResult
    {
        $percent = $this->getPercent();
        $value = (int)ceil($value / 100) * $percent;
        return new BasePriceResult($percent, $value);
    }
}
