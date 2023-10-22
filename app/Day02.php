<?php

namespace App;

class Day02
{
    const RANK = ["A" => 1, "B" => 2, "C" => 3, "X" => 1, "Y" => 2, "Z" => 3];
    const KNAR = ["A" => 1, "B" => 2, "C" => 3, "X" => 0, "Y" => 3, "Z" => 6];

    public static function partOne($rounds)
    {
        $outcomes = array_map(fn ($r) => self::round($r), $rounds);
        return array_sum($outcomes);
    }

    public static function partTwo($rounds)
    {
        $outcomes = array_map(fn ($r) => self::round($r), $rounds);
        return array_sum($outcomes);
    }

    private static function round($x)
    {
        [$a, $b] = explode(' ', $x);
        return self::score($a, $b);
    }

    private static function score($a, $b)
    {
        $ours = self::RANK[$b];
        $theirs = self::RANK[$a];
        return $ours + self::play($theirs, $ours);
    }

    private static function play($a, $b)
    {
        if ($a == $b) {
            return 3;
        }
        if (($a - $b + 3) % 3 == 1) {
            return 0;
        }
        return 6;
    }
}
