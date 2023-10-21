<?php

namespace App\TwentyTwo;

class Day04
{

    /**
     * One of ranges p1-p2, p3-p4 is a subset of the other
     */
    public static function conditionOne($p1, $p2, $p3, $p4): bool
    {
        return ($p1 <= $p3 && $p2 >= $p4) || ($p1 >= $p3 && $p2 <= $p4);
    }

    /**
     * One of ranges p1-p2, p3-p4 overlaps with the other
     */
    public static function conditionTwo($p1, $p2, $p3, $p4): bool
    {
        return !($p2 < $p3) && !($p1 > $p4);
    }

    public static function partOne($input): int
    {
        return self::run($input, self::conditionOne(...));
    }

    public static function partTwo($input): int
    {
        return self::run($input, self::conditionTwo(...));
    }

    private static function run($input, $check): int
    {
        $pairs = self::parseInput($input);
        $count = 0;

        foreach ($pairs as $p) {
            [$p1, $p2, $p3, $p4] = self::flattenRangePair($p);
            if ($check($p1, $p2, $p3, $p4)) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * @param $input
     * @return false[]|string[][]
     */
    private static function parseInput($input): array
    {
        return array_map(function ($i) {
            return explode(',', $i);
        }, $input);
    }

    /**
     * @param array $p
     * @return array
     */
    public static function flattenRangePair(array $p): array
    {
        [$r1, $r2] = array_map(fn($p) => explode('-', $p), $p);
        return [...$r1, ...$r2];
    }
}
