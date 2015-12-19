<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

class QualityControlFactory
{
    const AGED_BRIE         = "Aged Brie";
    const BACKSTAGE_PASSES  = "Backstage passes to a TAFKAL80ETC concert";
    const CONJURED          = "Conjured Mana Cake";

    public function qualityControlFor(Item $item)
    {
        if ($this->is(self::AGED_BRIE, $item)) {
            return new AgedBrieQualityControl();
        }

        if ($this->is(self::BACKSTAGE_PASSES, $item)) {
            return new BackstagePassesQualityControl();
        }

        if ($this->is(self::CONJURED, $item)) {
            return new ConjuredQualityControl();
        }

        return new DefaultQualityControl();
    }

    private function is($name, Item $item)
    {
        return $name === $item->name;
    }
}
