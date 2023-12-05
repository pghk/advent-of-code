<?php

namespace App\TwentyThree;

class Day04
{
    public array $cards;

    public function __construct(public array $input)
    {
        $this->cards = array_map(fn($l) => new Card($l), $input);
    }

    public function partOne(): int
    {
        $scores = array_map(function ($c) {
            return $c->play()->score();
        }, $this->cards);

        return array_sum($scores);
    }

    public function partTwo()
    {
        $ranges = array_map(function ($c) {
            return $c->play()->wins;
        }, $this->cards);

        $limit = count($ranges);
        $effects = array_fill_keys(range(0, $limit - 1), 1);

        foreach ($ranges as $i => $n) {
            if ($n == 0) {
                continue;
            }
            $v = $effects[$i];
            foreach (range(1, $n) as $m) {
                $k = $i + $m;
                if ($k == $limit) {
                    break;
                }
                $effects[$k] += $v;
            }
        }

        return array_sum($effects);
    }
}

class Card
{
    public array $winningNums;
    public array $playingNums;
    public int $wins = 0;

    public function __construct(string $def)
    {
        [$name, $nums] = explode(': ', $def);
        [$w, $p] = explode(' | ', $nums);
        $this->winningNums = static::parseNums($w);
        $this->playingNums = static::parseNums($p);
    }

    public function play(): static
    {
        foreach ($this->winningNums as $n) {
            if (in_array($n, $this->playingNums)) {
                $this->wins++;
            }
        }
        return $this;
    }

    public function score(): int
    {
        if ($this->wins == 0 || $this->wins == 1) {
            return $this->wins;
        }
        return 2 ** ($this->wins - 1);
    }

    private static function parseNums(string $s): array
    {
        $nums = explode(' ', $s);
        $cleaned = array_filter($nums, fn($n) => $n !== '');
        return array_values($cleaned);
    }

}