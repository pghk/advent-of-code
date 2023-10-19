<?php

namespace App\TwentyTwo;

class Day02
{
    const RANK = ["A" => 1, "B" => 2, "C" => 3];

    public static function partOne($input)
    {
        $rounds = array_map(fn ($i) => explode(' ', $i), $input);
        $outcomes = array_map(fn ($r) => self::strategyOne($r), $rounds);
        return array_sum($outcomes);
    }

    public static function partTwo($input)
    {
        $rounds = array_map(fn ($i) => explode(' ', $i), $input);
        $outcomes = array_map(fn ($r) => self::strategyTwo($r), $rounds);
        return array_sum($outcomes);
    }

    private static function strategyOne($round)
    {
        [$a, $b] = $round;
        $theirs = self::RANK[$a];
        $map = ["X" => 1, "Y" => 2, "Z" => 3];
        $ours = $map[$b];
        return self::score($theirs, $ours);
    }

    private static function strategyTwo($round)
    {
        [$a, $b] = $round;
        $theirs = $ours = self::RANK[$a];
        if ($b == "X") {
            $ours = $theirs == 1 ? 3 : ($theirs + 2) % 3;
        }
        if ($b == "Z") {
            $ours = $theirs == 2 ? 3 : ($theirs + 1) % 3;
        }
        return self::score($theirs, $ours);
    }

    private static function score($a, $b)
    {
        return $b + self::play($a, $b);
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
