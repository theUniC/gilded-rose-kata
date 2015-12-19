<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

class AgedBrieQualityControl extends QualityControl
{
    const MAX_QUALITY = 50;
    const DAYS_TO_SOLD_OUT = 0;

    public function updateQuality(Item $item)
    {
        $this->increaseItemQualityBy(1, $item);

        if ($this->soldOut($item)) {
            $this->increaseItemQualityBy(1, $item);
        }
    }

    private function increaseItemQualityBy($num, Item $item)
    {
        if ($item->quality < self::MAX_QUALITY) {
            $item->quality += $num;
        }
    }

    private function soldOut($item)
    {
        return $item->sellIn < self::DAYS_TO_SOLD_OUT;
    }
}