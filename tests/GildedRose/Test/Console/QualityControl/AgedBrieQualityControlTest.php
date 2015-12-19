<?php

namespace GildedRose\Test\Console\QualityControl;

use GildedRose\Console\Item;
use GildedRose\Console\QualityControl\AgedBrieQualityControl;
use PHPUnit_Framework_TestCase;

class AgedBrieQualityControlTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AgedBrieQualityControl
     */
    private $qualityControl;

    /**
     * @before
     */
    public function prepareAgedBrieQualityControl()
    {
        $this->qualityControl = new AgedBrieQualityControl();
    }

    /** @test */
    public function it_should_increase_in_quality_the_older_it_gets()
    {
        $agedBrie = new Item(['name' => 'Aged Brie', 'sellIn' => 10, 'quality' => 0]);

        $this->qualityControl->updateQuality($agedBrie);
        $this->qualityControl->updateQuality($agedBrie);
        $this->qualityControl->updateQuality($agedBrie);

        $this->assertEquals(3, $agedBrie->quality);
    }
}