<?php

namespace App\TwentyTwo;

class Day11
{
    private object $state;
    private int $max_worry = 1;
    private array $monkey_biz_logic;
    private array $monkey_biz_ratings;

    public function __construct(public array $input)
    {
        $start = (object)[];
        $monkeys = array_chunk($input, 7);
        foreach ($monkeys as $i => $lines) {
            $start->$i = explode(', ', explode(': ', $lines[1])[1]);

            $op = explode('d ', $lines[2])[1];
            $div = explode('y ', $lines[3])[1];
            $if = explode('y ', $lines[4])[1];
            $else = explode('y ', $lines[5])[1];

            $this->monkey_biz_logic[$i] = [
                'do' => static::getOperation($op),
                'test' => fn($x) => $x % $div == 0 ? 'pass' : 'fail',
                'pass' => $if,
                'fail' => $else
            ];

            $this->max_worry *= $div;
            $this->monkey_biz_ratings[$i] = 0;
        }

        $this->state = $start;
    }

    public function partOne(): int
    {
        $worryLess = fn($x) => floor($x / 3);
        foreach (range(1, 20) as $_) {
            $this->runRound($worryLess);
        }
        return $this->monkeyBusinessLevel();
    }

    public function partTwo(): int
    {
        $worryLess = fn($x) => $x % $this->max_worry;
        for ($i = 0; $i < 10000; $i++) {
            $this->runRound($worryLess);
        }
        return $this->monkeyBusinessLevel();
    }


    private static function getOperation($str): \Closure
    {
        [$op, $val] = explode(' ', $str);
        $operate = match ($op) {
            '+' => fn($x, $v) => $x + $v,
            '*' => fn($x, $v) => $x * $v,
        };
        return match ($val) {
            'old' => fn($x) => $operate($x, $x),
            default => fn($x) => $operate($x, $val)
        };
    }


    private function runRound($regulate): void
    {
        foreach ($this->monkey_biz_logic as $id => $monkey) {
            while (count($this->state->$id) > 0) {
                $this->monkey_biz_ratings[$id]++;

                $worry = array_shift($this->state->$id);
                $next_worry = $regulate($monkey['do']($worry));

                $pass_to = $monkey['test']($next_worry);
                $next_id = $monkey[$pass_to];

                $this->state->$next_id[] = $next_worry;
            }
        }
    }

    private function monkeyBusinessLevel(): int
    {
        sort($this->monkey_biz_ratings);
        [$a, $b] = array_slice($this->monkey_biz_ratings, -2);
        return $a * $b;
    }
}
