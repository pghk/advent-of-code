<?php

namespace App\TwentyTwo;

class Day11
{
    private object $round;
    private array $monkey_biz_logic;
    private array $monkey_biz_ratings;

    public function __construct(public array $input)
    {
        $defs = array_chunk($input, 7);
        $start = (object)[];
        foreach ($defs as $d) {
            $m = trim(explode(' ', $d[0])[1], ':');
            $items = array_map(fn($n) => $n, explode(', ', explode(': ', $d[1])[1]));
            $op = explode('old ', $d[2])[1];
            $test = explode('by ', $d[3])[1];
            $if = explode('y ', $d[4])[1];
            $else = explode('y ', $d[5])[1];

            $start->$m = $items;
            $this->monkey_biz_logic[$m] = [
                'op' => $this->parseOp($op),
                'test' => fn($x) => bcmod($x, $test) == 0 ? 'pass' : 'fail',
                'pass' => $if,
                'fail' => $else
            ];
            $this->monkey_biz_ratings[$m] = 0;
        }
        $this->round = $start;
    }

    private function parseOp($str): \Closure
    {
        [$operator, $value] = explode(' ', $str);
        $operation = match ($operator) {
            '+' => fn($x, $v) => bcadd($x, $v),
            '*' => fn($x, $v) => bcmul($x, $v),
        };
        return match ($value) {
            'old' => fn($x) => $operation($x, $x),
            default => fn($x) => $operation($x, $value)
        };
    }

    public function partOne(): int
    {
        $worryLess = fn ($x) => floor($x / 3);
        foreach (range(1, 20) as $_) {
            $this->runRound($worryLess);
        }
        return $this->monkeyBusinessLevel();
    }

    public function partTwo(): int
    {
        $worrySame = fn ($x) => $x;
        for ($i = 0; $i < 700; $i++) {
            $this->runRound($worrySame);
        }
        return $this->monkeyBusinessLevel();
    }

    private function runRound($reg): void
    {
        $prev = $this->round;
        $next = clone $prev;

        foreach ($this->monkey_biz_logic as $m => $b) {
            while (count($next->$m) > 0) {
                $this->monkey_biz_ratings[$m]++;
                $i = array_shift($next->$m);
                $j = $reg($b['op']($i));
                $r = $b['test']($j);
                $n = $b[$r];
                $next->$n[] = $j;
            }
        }

        $this->round = $next;
    }

    private function monkeyBusinessLevel(): int
    {
        sort($this->monkey_biz_ratings);
        [$a, $b] = array_slice($this->monkey_biz_ratings, -2);
        return $a * $b;
    }
}
