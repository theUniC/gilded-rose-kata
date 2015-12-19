<?php

namespace GildedRose\Test\Console\QualityControl;

use GildedRose\Console\Item;
use GildedRose\Console\QualityControl\BackstagePassesQualityControl;
use PHPUnit_Framework_TestCase;

class BackstagePassesQualityControlTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var BackstagePassesQualityControl
     */
    private $qualityControl;

    /**
     * @before
     */
    public function prepareBackstagePassesQualityControl()
    {
        $this->qualityControl = new BackstagePassesQualityControl();
    }

    /** @test */
    public function it_should_increase_in_quality_the_older_it_gets()
    {
        $backstage = new Item(['name' => "Backstage passes to a TAFKAL80ETC concert", 'sellIn' => 15, 'quality' => 20]);

        $this->qualityControl->updateQuality($backstage);
        $this->qualityControl->updateQuality($backstage);
        $this->qualityControl->updateQuality($backstage);

        $this->assertEquals(23, $backstage->quality);
    }

    /** @test */
    public function it_should_increase_in_quality_by_two_if_there_are_at_least_ten_days_to_run_out()
    {
        $backstage = new Item(['name' => "Backstage passes to a TAFKAL80ETC concert", 'sellIn' => 9, 'quality' => 3]);

        $this->qualityControl->updateQuality($backstage);

        $this->assertEquals(5, $backstage->quality);
    }

    /** @test */
    public function it_should_increase_in_quality_by_three_if_there_are_at_least_five_days_to_run_out()
    {
        $backstage = new Item(['name' => "Backstage passes to a TAFKAL80ETC concert", 'sellIn' => 4, 'quality' => 3]);

        $this->qualityControl->updateQuality($backstage);

        $this->assertEquals(6, $backstage->quality);
    }

    /** @test */
    public function it_should_drop_its_quality_if_it_has_been_sold_out()
    {
        $backstage = new Item(['name' => "Backstage passes to a TAFKAL80ETC concert", 'sellIn' => -1, 'quality' => 10]);

        $this->qualityControl->updateQuality($backstage);

        $this->assertEquals(0, $backstage->quality);
    }
}