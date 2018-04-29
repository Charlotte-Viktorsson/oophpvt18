<?php

namespace chvi17\Dice;

/**
 * A dice which has the ability to show a histogram.
 */
class DiceHistogram extends Dice implements HistogramInterface
{
    use HistogramTrait;

    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return $this->getSize();
    }

    /**
     * Roll the dice, remember its value in the serie and return
     * its value.
     *
     * @return int the value of the rolled dice.
     */
    public function roll()
    {
        $this->serie[] = parent::roll();
        return $this->getNr();
    }
}
