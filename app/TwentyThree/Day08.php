<?php

namespace App\TwentyThree;

class Day08
{
    /**
     * @var string[]
     */
    private array $instructions;

    /**
     * @var string[]
     */
    private array $map;

    public function __construct(public array $input)
    {
        $this->instructions = str_split($input[0]);
        $ids = [];
        $dirs = [];
        foreach (array_slice($this->input, 2) as $line) {
            [$id, $dir] = explode(' = ', $line);
            $ids[] = $id;
            $dirs[] = array_combine(
                ['L', 'R'],
                explode(', ', substr($dir, 1, -1))
            );
        };
        $this->map = array_combine($ids, $dirs);
    }

    public function partOne(): int
    {
        $steps = 0;
        $pos = 'AAA';
        while ($pos !== 'ZZZ') {
            foreach ($this->instructions as $i) {
                $pos = $this->map[$pos][$i];
                $steps++;
            }
        }
        return $steps;
    }

    public function partTwo(): int
    {
        $nodes = array_keys($this->map);
        $pos_ids = array_filter($nodes, fn($k) => str_ends_with($k, 'A'));

        $positions = array_values($pos_ids);
        $steps = array_fill(0, count($positions), 0);

        foreach ($positions as $k => $v) {
            $pos = $v;
            $step = 0;
            while (!str_ends_with($pos, 'Z')) {
                foreach ($this->instructions as $i) {
                    $pos = $this->map[$pos][$i];
                    $step++;
                }
                $steps[$k] = $step;
            }
        }

        $lcm = 1;
        foreach ($steps as $s) {
            $lcm = $this->lcm($lcm, $s);
        }
        return $lcm;
    }

    private function gcd($a, $b): int
    {
        $m = $a % $b;
        if ($m == 0) {
            return $b;
        }
        return $this->gcd($a, $m);
    }

    private function lcm($a, $b): int
    {
        return $a * $b / $this->gcd($a, $b);
    }

}
