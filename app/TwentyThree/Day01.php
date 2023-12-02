<?php

namespace App\TwentyThree;

class Day01
{
    private array $replacements;

    public function __construct(public array $input)
    {
        $words = ["one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];
        $digits = array_map(fn($i) => strval($i), range(1, 9));
        $this->replacements = array_combine($words, $digits);
    }

    public function partOne(): int
    {
        $numbers = array_map(fn($i) => static::stripAlphas($i), $this->input);
        return array_sum(static::integers($numbers));
    }

    public function partTwo()
    {
        $numbers = [];
        $p = '/(?=(one|two|three|four|five|six|seven|eight|nine|[1-9]))/';
        foreach ($this->input as $i) {
            $found = [];
            $matches = [];
            preg_match_all($p, $i, $matches);
            foreach ($matches[1] as $m) {
                $found[] = $m;
            }
            $numbers[] = join('', array_map(fn($n) => $this->normalize($n), $found));
        }

        return array_sum(static::integers($numbers));
    }

    private function normalize(string $n)
    {
        if (is_numeric($n)) {
            return $n;
        }
        return $this->replacements[$n];
    }

    private static function integers(array $numbers): array
    {
        return array_map(function ($i) {
            var_dump($i);
            $n = join('', [$i[0], $i[-1]]);
            return intval($n);
        }, $numbers);
    }

    private static function stripAlphas(string $i): string
    {
        return preg_replace('/[[:alpha:]]/i', '', $i);
    }
}
