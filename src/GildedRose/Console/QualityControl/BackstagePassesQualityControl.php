<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

class BackstagePassesQualityControl extends QualityControl
{
    const DAYS_TO_INCREASE_QUALITY_BY_2 = 11;
    const DAYS_TO_INCREASE_QUALITY_BY_3 = 6;
    const LOWEST_QUALITY = 0;
    const SULFURAS = "Sulfuras, Hand of Ragnaros";

    public function updateQuality(Item $item)
    {
        $this->increaseItemQualityBy(1, $item);

        if ($item->sellIn < self::DAYS_TO_INCREASE_QUALITY_BY_2) {
            $this->increaseItemQualityBy(1, $item);
        }

        if ($item->sellIn < self::DAYS_TO_INCREASE_QUALITY_BY_3) {
            $this->increaseItemQualityBy(1, $item);
        }

        if ($this->soldOut($item)) {
            $this->decreaseItemQualityBy($item->quality, $item);
        }
    }

    private function decreaseItemQualityBy($num, Item $item)
    {
        if ($item->quality > self::LOWEST_QUALITY) {
            if ($item->name != self::SULFURAS) {
                $this->increaseItemQualityBy(($num * (-1)), $item);
            }
        }
    }
}