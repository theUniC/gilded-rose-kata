<?php

namespace GildedRose\Test\Console;

use GildedRose\Console\Item;
use GildedRose\Console\Program;
use PHPUnit_Framework_TestCase;

class ProgramTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_not_sell_sulfuras()
    {
        $item = new Item(['name' => "Sulfuras, Hand of Ragnaros", 'sellIn' => 5, 'quality' => 80]);

        $app = new Program([
            $item
        ]);

        $app->UpdateQuality();

        $this->assertEquals(5, $item->sellIn);
    }

    /** @test */
    public function it_should_sell_non_sulfuras_items()
    {
        $agedBrie   = new Item(['name' => "Aged Brie", "sellIn" => 2, 'quality' => 10]);
        $backstage  = new Item(['name' => "Backstage passes to a TAFKAL80ETC concert", 'sellIn' => 15, 'quality' => 20]);
        $conjured   = new Item(['name' => 'Conjured Mana Cake','sellIn' => 3,'quality' => 6]);
        $default    = new Item(['name' => '+5 Dexterity Vest', 'sellIn' => 10, 'quality' => 20]);

        $app = new Program([$agedBrie, $backstage, $conjured, $default]);

        $app->UpdateQuality();

        $this->assertEquals(1,      $agedBrie->sellIn);
        $this->assertEquals(14,     $backstage->sellIn);
        $this->assertEquals(2,      $conjured->sellIn);
        $this->assertEquals(9,      $default->sellIn);
    }
}