<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

class ConjuredQualityControl extends QualityControl
{
    public function updateQuality(Item $item)
    {
        $this->decreaseItemQualityBy(2, $item);
    }
}