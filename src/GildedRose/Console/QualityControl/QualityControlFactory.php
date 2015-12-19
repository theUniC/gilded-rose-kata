<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

class QualityControlFactory
{
    const AGED_BRIE         = "Aged Brie";
    const BACKSTAGE_PASSES  = "Backstage passes to a TAFKAL80ETC concert";

    public function qualityControlFor(Item $item)
    {
        if ($this->is(self::AGED_BRIE, $item)) {
            return new AgedBrieQualityControl();
        }

        if ($this->is(self::BACKSTAGE_PASSES, $item)) {
            return new BackstagePassesQualityControl();
        }

        return new DefaultQualityControl();
    }

    private function is($name, Item $item)
    {
        return $name === $item->name;
    }
}