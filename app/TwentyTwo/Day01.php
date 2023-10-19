<?php

namespace App\TwentyTwo;

class Day01
{
    public static function partOne($input)
    {
        $c = self::process($input);
        sort($c);
        return array_slice($c, -1)[0];
    }

    public static function partTwo($input)
    {
        $c = self::process($input);
        sort($c);
        return array_sum(array_slice($c, -3));
    }

    private static function process($input)
    {
        $a = explode("\n\n", $input);
        $b = array_map(fn ($i) => explode("\n", $i), $a);
        $c = array_map(fn ($i) => array_sum($i), $b);
        return $c;
    }
}
