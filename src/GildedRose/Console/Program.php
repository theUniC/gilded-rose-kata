<?php

namespace GildedRose\Console;

/**
 * Hi and welcome to team Gilded Rose.
 *
 * As you know, we are a small inn with a prime location in a prominent city
 * ran by a friendly innkeeper named Allison. We also buy and sell only the
 * finest goods. Unfortunately, our goods are constantly degrading in quality
 * as they approach their sell by date. We have a system in place that updates
 * our inventory for us. It was developed by a no-nonsense type named Leeroy,
 * who has moved on to new adventures. Your task is to add the new feature to
 * our system so that we can begin selling a new category of items. First an
 * introduction to our system:
 *
 * - All items have a SellIn value which denotes the number of days we have to sell the item
 * - All items have a Quality value which denotes how valuable the item is
 * - At the end of each day our system lowers both values for every item
 *
 * Pretty simple, right? Well this is where it gets interesting:
 *
 * - Once the sell by date has passed, Quality degrades twice as fast
 * - The Quality of an item is never negative
 * - "Aged Brie" actually increases in Quality the older it gets
 * - The Quality of an item is never more than 50
 * - "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
 * - "Backstage passes", like aged brie, increases in Quality as it's SellIn
 *   value approaches; Quality increases by 2 when there are 10 days or less and
 *   by 3 when there are 5 days or less but Quality drops to 0 after the concert
 *
 * We have recently signed a supplier of conjured items. This requires an
 * update to our system:
 *
 * - "Conjured" items degrade in Quality twice as fast as normal items
 *
 * Feel free to make any changes to the UpdateQuality method and add any new
 * code as long as everything still works correctly. However, do not alter the
 * Item class or Items property as those belong to the goblin in the corner who
 * will insta-rage and one-shot you as he doesn't believe in shared code
 * ownership (you can make the UpdateQuality method and Items property static
 * if you like, we'll cover for you).
 *
 * Just for clarification, an item can never have its Quality increase above
 * 50, however "Sulfuras" is a legendary item and as such its Quality is 80 and
 * it never alters.
 */
class Program
{
    private $items = array();

    const MAX_QUALITY = 50;

    const LOWEST_QUALITY = 0;

    const DAYS_TO_INCREASE_QUALITY_BY_2 = 11;

    const DAYS_TO_INCREASE_QUALITY_BY_3 = 6;

    public static function main()
    {
        echo 'OMGHAI!' . PHP_EOL;

        $app = new Program([
            new Item(['name' => '+5 Dexterity Vest', 'sellIn' => 10, 'quality' => 20]),
            new Item(['name' => 'Aged Brie', "sellIn" => 2, 'quality' => self::LOWEST_QUALITY]),
            new Item(['name' => 'Aged Brie', "sellIn" => -1, 'quality' => self::LOWEST_QUALITY]),
            new Item(['name' => 'Elixir of the Mongoose', 'sellIn' => 5, 'quality' => 7]),
            new Item(['name' => 'Elixir of the Mongoose', 'sellIn' => -1, 'quality' => 7]),
            new Item(['name' => 'Sulfuras, Hand of Ragnaros', 'sellIn' => self::LOWEST_QUALITY, 'quality' => 80]),
            new Item(['name' => 'Sulfuras, Hand of Ragnaros', 'sellIn' => -1, 'quality' => 80]),
            new Item(['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 15, 'quality' => 20]),
            new Item(['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 10, 'quality' => 49]),
            new Item(['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 5, 'quality' => 49]),
            new Item(['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 5, 'quality' => 48]),
            new Item(['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 5, 'quality' => 10]),
            new Item(['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => -1, 'quality' => 10]),
            new Item(['name' => 'Conjured Mana Cake','sellIn' => 3,'quality' => 6]),
        ]);

        $app->UpdateQuality();

        echo sprintf('%50s - %7s - %7s', 'Name', 'SellIn', 'Quality') . PHP_EOL;
        foreach ($app->items as $item) {
            echo sprintf('%50s - %7d - %7d', $item->name, $item->sellIn, $item->quality) . PHP_EOL;
        }
    }

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function UpdateQuality()
    {
        for ($i = 0; $i < count($this->items); $i++) {
            $item = $this->items[$i];
            if ($item->name != "Aged Brie" && $this->items[$i]->name != "Backstage passes to a TAFKAL80ETC concert") {
                if ($this->items[$i]->quality > self::LOWEST_QUALITY) {
                    if ($this->items[$i]->name != "Sulfuras, Hand of Ragnaros") {
                        $this->decreaseItemQualityBy(1, $this->items[$i]);
                    }
                }
            } else {
                if ($this->items[$i]->quality < self::MAX_QUALITY) {
                    $this->increaseItemQualityBy(1, $this->items[$i]);

                    if ($this->items[$i]->name == "Backstage passes to a TAFKAL80ETC concert") {
                        if ($this->items[$i]->sellIn < self::DAYS_TO_INCREASE_QUALITY_BY_2) {
                            if ($this->items[$i]->quality < self::MAX_QUALITY) {
                                $this->increaseItemQualityBy(1, $this->items[$i]);
                            }
                        }

                        if ($this->items[$i]->sellIn < self::DAYS_TO_INCREASE_QUALITY_BY_3) {
                            if ($this->items[$i]->quality < self::MAX_QUALITY) {
                                $this->increaseItemQualityBy(1, $this->items[$i]);
                            }
                        }
                    }
                }
            }

            if ($this->items[$i]->name != "Sulfuras, Hand of Ragnaros") {
                $this->items[$i]->sellIn = $this->items[$i]->sellIn - 1;
            }

            if ($this->items[$i]->sellIn < 0) {
                if ($this->items[$i]->name != "Aged Brie") {
                    if ($this->items[$i]->name != "Backstage passes to a TAFKAL80ETC concert") {
                        if ($this->items[$i]->quality > self::LOWEST_QUALITY) {
                            if ($this->items[$i]->name != "Sulfuras, Hand of Ragnaros") {
                                $this->decreaseItemQualityBy(1, $this->items[$i]);
                            }
                        }
                    } else {
                        $this->increaseItemQualityBy(-$this->items[$i]->quality, $this->items[$i]);
                    }
                } else {
                    if ($this->items[$i]->quality < self::MAX_QUALITY) {
                        $this->increaseItemQualityBy(1, $this->items[$i]);
                    }
                }
            }
        }
    }

    private function increaseItemQualityBy($num, Item $item)
    {
        $item->quality += $num;
    }

    private function decreaseItemQualityBy($num, Item $item)
    {
        $this->increaseItemQualityBy(($num * (-1)), $item);
    }
}
