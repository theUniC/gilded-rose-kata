<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

class QualityControlFactory
{
    const AGED_BRIE = "Aged Brie";
    const BACKSTAGE_PASSES = "Backstage passes to a TAFKAL80ETC concert";

    public function qualityControlFor(Item $item)
    {
        $qualityControl = new DefaultQualityControl();

        if (self::AGED_BRIE === $item->name) {
            $qualityControl = new AgedBrieQualityControl();
        }

        if (self::BACKSTAGE_PASSES === $item->name) {
            $qualityControl = new BackstagePassesQualityControl();
        }

        return $qualityControl;
    }
}