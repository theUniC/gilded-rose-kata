<?php

namespace GildedRose\Test\Console;

use GildedRose\Console\Program;
use PHPUnit_Framework_TestCase;

class ProgramTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_display_the_correct_output()
    {
        $this->expectOutputString(<<<EOO
OMGHAI!
                                              Name -  SellIn - Quality
                                 +5 Dexterity Vest -       9 -      19
                                         Aged Brie -       1 -       1
                                         Aged Brie -      -2 -       2
                            Elixir of the Mongoose -       4 -       6
                            Elixir of the Mongoose -      -2 -       5
                        Sulfuras, Hand of Ragnaros -       0 -      80
                        Sulfuras, Hand of Ragnaros -      -1 -      80
         Backstage passes to a TAFKAL80ETC concert -      14 -      21
         Backstage passes to a TAFKAL80ETC concert -       9 -      50
         Backstage passes to a TAFKAL80ETC concert -       4 -      50
         Backstage passes to a TAFKAL80ETC concert -       4 -      50
         Backstage passes to a TAFKAL80ETC concert -       4 -      13
         Backstage passes to a TAFKAL80ETC concert -      -2 -       0
                                Conjured Mana Cake -       2 -       5

EOO
        );

        Program::main();
    }
}