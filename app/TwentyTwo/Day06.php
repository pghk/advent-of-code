<?php

namespace App\TwentyTwo;

use phpDocumentor\Reflection\Type;

class Day06
{
    const MARK_LENGTH = 4;
    const MSG_LENGTH = 14;

    public static function partOne($input)
    {
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

     public static function partTwo($input)
     {
         for ($i = 0; $i < strlen($input); $i++) {
             $chars = str_split($input);
             $w = array_slice($chars, $i, self::MSG_LENGTH);
             $check = array_reduce($w, function ($a, $x) {
                 if (!$a) {
                     $a = [];
                 }
                 if (!in_array($x, $a)) {
                     $a[] = $x;
                 }
                 return $a;
             });
             if (count($check) == self::MSG_LENGTH) {
                 return $i + self::MSG_LENGTH;
             }
         }
     }
}
