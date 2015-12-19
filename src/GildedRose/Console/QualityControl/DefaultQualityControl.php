<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

class DefaultQualityControl extends QualityControl
{
    public function updateQuality(Item $item)
    {
        $this->decreaseItemQualityBy(1, $item);

        if ($this->soldOut($item)) {
            $this->decreaseItemQualityBy(1, $item);
        }
    }
}