<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

class BackstagePassesQualityControl extends QualityControl
{
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
}