<?php

namespace GildedRose\Console;

class Item
{
    public $name;
    public $sellIn;
    public $quality;

    public function __construct(array $parts)
    {
        foreach ($parts as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }
}
