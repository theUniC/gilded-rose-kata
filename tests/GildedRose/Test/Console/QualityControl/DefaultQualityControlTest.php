<?php

namespace GildedRose\Test\Console\QualityControl;

use GildedRose\Console\Item;
use GildedRose\Console\QualityControl\DefaultQualityControl;
use PHPUnit_Framework_TestCase;

class DefaultQualityControlTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var DefaultQualityControl
     */
    private $qualityControl;

    /**
     * @before
     */
    public function prepareAgedBrieQualityControl()
    {
        $this->qualityControl = new DefaultQualityControl();
    }

    /** @test */
    public function it_should_decrease_in_quality_the_older_it_gets()
    {
        $item = new Item(['name' => '+5 Dexterity Vest', 'sellIn' => 10, 'quality' => 20]);

        $this->qualityControl->updateQuality($item);

        $this->assertEquals((20 - 1), $item->quality);
    }

    /** @test */
    public function it_should_decrease_in_quality_by_two_if_it_has_been_sold_out()
    {
        $item = new Item(['name' => '+5 Dexterity Vest', 'sellIn' => -1, 'quality' => 20]);

        $this->qualityControl->updateQuality($item);

        $this->assertEquals((20 - 2), $item->quality);
    }
}