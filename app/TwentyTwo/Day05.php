<?php

namespace App\TwentyTwo;

class Day05
{
    public static function partOne($input)
    {
        $crates = [];
        $stacks = [];
        $map = [];
        $moves = [];

        $i = 0;
        while ($i < count($input)) {
            $str = $input[$i];
            $type = self::getType($input[$i]);
            match ($type) {
                'crate' => $crates[] = $str,
                'stack' => [$stacks, $map] = self::getStacks($str),
                'move' => $moves[] = $str,
                default => ''
            };
            $i++;
        }
        $stacks = self::stackCrates($crates, $stacks, $map);
        $moves = self::parseMoves($moves);

        foreach ($moves as $k => $v)
        {
            [$quantity, $source, $destination] = $v;
            foreach (range(1, $quantity) as $i) {
                $stacks[$destination][] = array_pop($stacks[$source]);
            }
        }

        return join(array_map(fn ($s) => array_pop($s), $stacks));
    }

    // public static function partTwo($input)
    // {
    //
    // }

    private static function parseMoves($moves): array
    {
        return array_map(function ($m) {
            $values = preg_replace('/\D+/', ' ', $m);
            return explode(' ', trim($values));
        }, $moves);
    }

    private static function getStacks($str): array
    {
        $stacks = [];
        $map = [];
        foreach(str_split($str) as $i => $char) {
            if ($char == ' ') {
                continue;
            }
            $stacks[$char] = [];
            $map[$i] = $char;
        }
        return [$stacks, $map];
    }

    private static function stackCrates($crates, $stacks, $map): array
    {
        foreach ($crates as $str) {
            foreach ($map as $k => $v) {
                if ($str[$k] !== ' ') {
                    array_unshift($stacks[$v], $str[$k]);
                }
            }
        }
        return $stacks;
    }

    /**
     * @param $haystack
     * @return string
     */
    private static function getType($haystack): string
    {
        return match (true) {
            str_contains($haystack, '[') => 'crate',
            str_contains($haystack, 'move') => 'move',
            (bool)preg_match('/\d/', $haystack) => 'stack',
            default => '',
        };
    }
}
