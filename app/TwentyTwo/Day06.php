<?php

namespace App\TwentyTwo;

use phpDocumentor\Reflection\Type;

class Day06
{
    const MARK_LENGTH = 4;

    public static function partOne($input)
    {
        $mark_at = 0;
        for ($i = 0; $i < strlen($input); $i++) {
            $chars = str_split($input);
            $w = array_slice($chars, $i, self::MARK_LENGTH);
            $check = array_reduce($w, function ($a, $x) {
                if (!$a) {
                    $a = [];
                }
                if (!in_array($x, $a)) {
                    $a[] = $x;
                }
                return $a;
            });
            if (count($check) == self::MARK_LENGTH) {
                return $i + self::MARK_LENGTH;
            }
        }
    }

    // public static function partTwo($input)
    // {
    //
    // }
}
