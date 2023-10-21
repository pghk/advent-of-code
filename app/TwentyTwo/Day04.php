<?php

namespace App\TwentyTwo;

class Day04
{
    public static function partOne($input)
    {
        $pairs = array_map(function ($i) {
            return explode(',', $i);
        }, $input);

        $count = 0;

        foreach ($pairs as $i) {
            [$a, $b] = array_map(function ($i) {
                $i = explode('-', $i);
                return $i;
            }, $i);
            if (
                ($a[0] <= $b[0] && $a[1] >= $b[1]) ||
                ($a[0] >= $b[0] && $a[1] <= $b[1])
            ) {
                $count++;
            }
        }

        return $count;
    }

    public static function partTwo($input)
    {
        $pairs = array_map(function ($i) {
            return explode(',', $i);
        }, $input);

        $count = 0;

        foreach ($pairs as $i) {
            [$a, $b] = array_map(function ($i) {
                $i = explode('-', $i);
                return $i;
            }, $i);
            if (
                ($a[0] >= $b[0] && $a[0] <= $b[1]) ||
                ($a[1] >= $b[0] && $a[1] <= $b[1]) ||
                ($b[0] >= $a[0] && $b[0] <= $a[1]) ||
                ($b[1] >= $a[0] && $b[1] <= $a[1])
            ) {
                $count++;
            }
        }

        return $count;
    }
}
