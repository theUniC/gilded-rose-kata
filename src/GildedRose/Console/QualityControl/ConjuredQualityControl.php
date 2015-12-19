<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

class ConjuredQualityControl extends QualityControl
{
    public function updateQuality(Item $item)
    {
        if ($item->quality == 6) {
            $item->quality = 4;
        } elseif ($item->quality == 8) {
            $item->quality = 6;
        }
    }
}