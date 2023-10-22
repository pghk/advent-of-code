<?php

namespace App;

class Main
{
    public static function first($in)
    {
        $a = explode("\n\n", $in);
        $b = array_map(fn ($i) => explode("\n", $i), $a);
        $c = array_map(fn ($i) => array_sum($i), $b);
        sort($c);
        return array_reverse($c)[0];
    }
}
