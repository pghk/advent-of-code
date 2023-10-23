<?php

namespace App\TwentyTwo;

use phpDocumentor\Reflection\Type;

class Day06
{
    const MARK_LENGTH = 4;
    const MSG_LENGTH = 14;

    public static function partOne($input): ?int
    {
        return self::process($input, self::MARK_LENGTH);
    }

     public static function partTwo($input): ?int
     {
         return self::process($input, self::MSG_LENGTH);
     }

    /**
     * @param $input
     * @param $length
     * @return int|void
     */
    public static function process($input, $length)
    {
        for ($i = 0; $i < strlen($input); $i++) {
            $chars = str_split($input);
            $w = array_slice($chars, $i, $length);
            $check = array_reduce($w, function ($a, $x) {
                if (!$a) {
                    $a = [];
                }
                if (!in_array($x, $a)) {
                    $a[] = $x;
                }
                return $a;
            });
            if (count($check) == $length) {
                return $i + $length;
            }
        }
    }
}
