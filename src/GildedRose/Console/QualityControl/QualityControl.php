<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

abstract class QualityControl
{
    const MAX_QUALITY = 50;
    const LOWEST_QUALITY = 0;

    const DAYS_TO_SOLD_OUT = 0;
    const DAYS_TO_INCREASE_QUALITY_BY_2 = 11;
    const DAYS_TO_INCREASE_QUALITY_BY_3 = 6;

    const SULFURAS = "Sulfuras, Hand of Ragnaros";

    protected function increaseItemQualityBy($num, Item $item)
    {
        if ($item->quality < self::MAX_QUALITY) {
            $item->quality += $num;
        }
    }

    protected function decreaseItemQualityBy($num, Item $item)
    {
        if ($item->quality > self::LOWEST_QUALITY) {
            if ($item->name != self::SULFURAS) {
                $this->increaseItemQualityBy(($num * (-1)), $item);
            }
        }
    }

    protected function soldOut($item)
    {
        return $item->sellIn < self::DAYS_TO_SOLD_OUT;
    }

    abstract public function updateQuality(Item $item);
}