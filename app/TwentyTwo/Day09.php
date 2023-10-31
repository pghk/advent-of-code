<?php

namespace App\TwentyTwo;

class Day09
{
    const START = ['x' => 0, 'y' => 0];
    private array $tailPositions;

    public function __construct(public array $input)
    {
        $tail = $head = self::START;
        foreach ($input as $move) {
            [$d, $n] = explode(' ', $move);
            for ($i = 0; $i < $n; $i++) {
                $head = $this->move($head, $d);
                $tail = $this->follow($head, $tail);
//                print_r(json_encode($tail) . "\n");
                $key = join(",", array_values($tail));
//                print_r($key . "\n");
                $this->tailPositions[$key] = true;
            }
        }
    }

    public function partOne()
    {
//        print_r($this->tailPositions);
        return count($this->tailPositions);
    }

    // public function partTwo()
    // {
    //
    // }

    private function move($from, $dir): array
    {
        ['x' => $x, 'y' => $y] = $from;
        return match ($dir) {
            'U' => ['x' => $x, 'y' => $y + 1],
            'D' => ['x' => $x, 'y' => $y - 1],
            'L' => ['x' => $x - 1, 'y' => $y],
            'R' => ['x' => $x + 1, 'y' => $y],
            'UL' => ['x' => $x - 1, 'y' => $y + 1],
            'UR' => ['x' => $x + 1, 'y' => $y + 1],
            'DL' => ['x' => $x - 1, 'y' => $y - 1],
            'DR' => ['x' => $x + 1, 'y' => $y - 1],
        };
    }

    private function follow(array $head, array $tail): array
    {
        ['x' => $a, 'y' => $b] = $head;
        ['x' => $x, 'y' => $y] = $tail;
        $diff = [$a - $x, $b - $y];
//        print_r(json_encode($diff));
        return match ($diff) {
            [+0, +2] => $this->move($tail, 'U'),
            [+0, -2] => $this->move($tail, 'D'),
            [+2, +0] => $this->move($tail, 'R'),
            [-2, +0] => $this->move($tail, 'L'),
            [+1, +2], [+2, +1] => $this->move($tail, 'UR'),
            [-1, +2], [-2, +1] => $this->move($tail, 'UL'),
            [+1, -2], [+2, -1] => $this->move($tail, 'DR'),
            [-1, -2], [-2, -1] => $this->move($tail, 'DL'),
            default => $tail
        };
    }
}