<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

abstract class QualityControl
{
    const MAX_QUALITY = 50;
    const DAYS_TO_SOLD_OUT = 0;

    protected function increaseItemQualityBy($num, Item $item)
    {
        if ($item->quality < self::MAX_QUALITY) {
            $item->quality += $num;
        }
    }

    protected function soldOut($item)
    {
        return $item->sellIn < self::DAYS_TO_SOLD_OUT;
    }

    abstract public function updateQuality(Item $item);
}