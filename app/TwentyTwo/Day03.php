<?php

namespace App\TwentyTwo;

class Day03
{
    private $priorityMap;

    function __construct()
    {
        $this->priorityMap = array_combine(
            array_merge(
                range('a', 'z'),
                range('A', 'Z'),
            ),
            range(1, 52),
        );
    }

    public function partOne($input)
    {
        $items = self::prioritizeCommonItems($input);
        return array_sum($items);
    }

    public function partTwo($input)
    {
        $badges = [];
        while (count($input) > 0) {
            $group = array_splice($input, 0, 3);
            $badge = self::findCommonItems(
                self::findCommonItems($group[0], $group[1]),
                self::findCommonItems($group[1], $group[2])
            );
            $badges[] = $this->priorityMap[$badge];
        }
        return array_sum($badges);
    }

    private function prioritizeCommonItems($rs)
    {
        return array_map(function ($r) {
            [$a, $b] = self::compartments($r);
            $item = self::findCommonItems($a, $b);
            return $this->priorityMap[$item];
        }, $rs);
    }

    private static function compartments($r)
    {
        $l = strlen($r);
        return str_split($r, $l / 2);
    }

    private static function findCommonItems($a, $b)
    {
        $c = array_intersect(str_split($a), str_split($b));
        return array_reduce(
            $c,
            fn ($x, $y) => str_contains($x, $y) ? $x : $x . $y,
            ''
        );
    }
}
