<?php

namespace GildedRose\Console\QualityControl;

use GildedRose\Console\Item;

abstract class QualityControl
{
    abstract public function updateQuality(Item $item);
}