<?php

namespace App\TwentyTwo;

class Day11
{
    private array $rounds;
    private array $monkey_biz_logic;
    private array $monkey_biz_ratings;

    public function __construct(public array $input)
    {
        $defs = array_chunk($input, 7);
        $start = (object)[];
        foreach ($defs as $d) {
            $m = trim(explode(' ', $d[0])[1], ':');
            $items = array_map(fn($n) => (int)$n, explode(', ', explode(': ', $d[1])[1]));
            $op = explode('old ', $d[2])[1];
            $test = explode('by ', $d[3])[1];
            $if = explode('y ', $d[4])[1];
            $else = explode('y ', $d[5])[1];

            $start->$m = $items;
            $this->monkey_biz_logic[$m] = [
                'op' => $this->parseOp($op),
                'test' => fn($x) => $x % $test == 0 ? 'pass' : 'fail',
                'pass' => $if,
                'fail' => $else
            ];
            $this->monkey_biz_ratings[$m] = 0;
        }
        $this->rounds[] = $start;
    }

    private function parseOp($str): \Closure
    {
        [$operator, $value] = explode(' ', $str);
        $operation = match ($operator) {
            '+' => fn($x, $v) => $x + $v,
            '-' => fn($x, $v) => $x - $v,
            '*' => fn($x, $v) => $x * $v,
            '/' => fn($x, $v) => $x / $v,
        };
        return match ($value) {
            'old' => fn($x) => $operation($x, $x),
            default => fn($x) => $operation($x, (int)$value)
        };
    }

    public function partOne()
    {
        foreach (range(1, 20) as $_) {
            $this->runRound();
        }
        sort($this->monkey_biz_ratings);
        [$a, $b] = array_slice($this->monkey_biz_ratings, -2);
        return $a * $b;
    }

    // public function partTwo()
    // {
    //
    // }

    public function runRound(): void
    {
        $prev = $this->rounds[count($this->rounds) - 1];
        $next = clone $prev;

        foreach ($this->monkey_biz_logic as $m => $b) {
            while (count($next->$m) > 0) {
                $this->monkey_biz_ratings[$m]++;
                $i = array_shift($next->$m);
                $j = floor($b['op']($i) / 3);
                $r = $b['test']($j);
                $n = $b[$r];
                $next->$n[] = $j;
            }
        }

        $this->rounds[] = $next;
    }
}
