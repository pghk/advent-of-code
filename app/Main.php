<?php

namespace App;

class Main
{
    public static function first($in)
    {
        $c = self::process($in);
        sort($c);
        return array_slice($c, -1)[0];
    }

    public static function second($in)
    {
        $c = self::process($in);
        sort($c);
        return array_sum(array_slice($c, -3));
    }

    private static function process($in)
    {
        $a = explode("\n\n", $in);
        $b = array_map(fn ($i) => explode("\n", $i), $a);
        $c = array_map(fn ($i) => array_sum($i), $b);
        return $c;
    }
}
