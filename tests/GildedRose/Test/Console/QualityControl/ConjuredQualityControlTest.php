<?php

namespace GildedRose\Test\Console\QualityControl;

use GildedRose\Console\Item;
use PHPUnit_Framework_TestCase;
use GildedRose\Console\QualityControl\ConjuredQualityControl;

class ConjuredQualityControlTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ConjuredQualityControl
     */
    private $qualityControl;

    /**
     * @before
     */
    public function prepareConjuredQualityControl()
    {
        $this->qualityControl = new ConjuredQualityControl();
    }

    /** @test */
    public function it_should_degrage_in_quality_by_twice_compared_with_other_items()
    {
        $conjured = new Item(['name' => 'Conjured Mana Cake','sellIn' => 3,'quality' => 6]);

        $this->qualityControl->updateQuality($conjured);

        $this->assertEquals(4, $conjured->quality);
    }
}