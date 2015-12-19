<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

class AgedBrieQualityControl extends QualityControl
{
    public function updateQuality(Item $item)
    {
        $this->increaseItemQualityBy(1, $item);

        if ($this->soldOut($item)) {
            $this->increaseItemQualityBy(1, $item);
        }
    }

}