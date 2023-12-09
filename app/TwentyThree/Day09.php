<?php

namespace App\TwentyThree;

class Day09
{
    private array $history = [];
    private mixed $patterns;

    public function __construct(public array $input)
    {
        foreach ($input as $line) {
            $this->history[] = array_map(
                fn($l) => intval($l),
                explode(' ', $line)
            );
        }
        foreach ($this->history as $i => $items) {
            while (!$this->hasPattern($items)) {
                $next = [];
                for ($k = 1; $k < count($items); $k++) {
                    $next[] = $items[$k] - $items[$k - 1];
                }
                $items = $next;
                $this->patterns[$i][] = $next;
            }
        }
    }

    public function partOne(): int
    {
        $next = [];

        foreach ($this->history as $k => $v) {
            $offset = 0;
            foreach (array_reverse($this->patterns[$k]) as $p) {
                $offset += end($p);
            }
            $next[] = $offset + end($v);
        }

        return array_sum($next);
    }

    // public function partTwo()
    // {
    //
    // }

    private function hasPattern($items): bool
    {
        foreach ($items as $i) {
            if ($i !== 0) {
                return false;
            }
        }
        return true;
    }

}
