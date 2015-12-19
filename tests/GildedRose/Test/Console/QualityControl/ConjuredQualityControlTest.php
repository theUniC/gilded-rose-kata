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
        $conjured1 = new Item(['name' => 'Conjured Mana Cake','sellIn' => 3,'quality' => 6]);
        $conjured2 = new Item(['name' => 'Conjured Mana Cake','sellIn' => 3,'quality' => 8]);

        $this->qualityControl->updateQuality($conjured1);
        $this->qualityControl->updateQuality($conjured2);

        $this->assertEquals(4, $conjured1->quality);
        $this->assertEquals(6, $conjured2->quality);
    }
}