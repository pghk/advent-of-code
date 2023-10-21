<?php

namespace App\TwentyTwo;

class Day04
{

    public static function conditionOne($a, $b): bool
    {
        return ($a[0] <= $b[0] && $a[1] >= $b[1]) ||
            ($a[0] >= $b[0] && $a[1] <= $b[1]);
    }

    public static function conditionTwo($a, $b): bool
    {
        return ($a[0] >= $b[0] && $a[0] <= $b[1]) ||
            ($a[1] >= $b[0] && $a[1] <= $b[1]) ||
            ($b[0] >= $a[0] && $b[0] <= $a[1]) ||
            ($b[1] >= $a[0] && $b[1] <= $a[1]);
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
            [$a, $b] = self::splitPair($p);
            if ($check($a, $b)) {
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
     * @param array|false $i
     * @return array
     */
    public static function splitPair(array|false $i): array
    {
        return array_map(function ($i) {
            return explode('-', $i);
        }, $i);
    }
}
