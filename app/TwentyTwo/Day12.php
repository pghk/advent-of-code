<?php

namespace App\TwentyTwo;

class Day12
{
    private array $grid;
    private array $to_search = [];
    private array $search_history = [];
    private array $end_values;

    public function __construct(public array $input)
    {
        $this->grid = $input;
        $this->setStart('E');
    }

    public function partOne()
    {
        $this->end_values = ['S'];
        return $this->search();
    }

     public function partTwo()
     {
         $this->end_values = ['a', 'S'];
         return $this->search();
     }

    private function search()
    {
        $found = false;
        while ($found == null && count($this->to_search)) {
            $i = array_shift($this->to_search);
            if (array_key_exists($i['key'], $this->search_history)) {
                continue;
            }
            $this->search_history[$i['key']] = $i['dist'];
            $found = $this->reviewPaths($i);
        }
        return $found;
    }

    private function reviewPaths($start)
    {
        $depth = $start['dist'];
        $next = $this->chartPaths($start['key']);
        $found = null;
        foreach ($next as $path) {
            $path['dist'] = $depth + 1;
            if (in_array($path['value'], $this->end_values)) {
                $found = $path['dist'];
                break;
            }
            $this->to_search[] = $path;
        }
        return $found;
    }

    private function chartPaths($key): array
    {
        [$x, $y] = array_map(fn($i) => intval($i), explode('-', $key));
        $valid = [];
        $elevation = array_merge(
            ['S' => 1, 'E' => 26],
            array_combine(range("a", "z"), range(1, 26))
        );
        $a = $this->getCell($x, $y);
        foreach ($this->getNeighbors($x, $y) as $n => $i) {
            $b = $i['value'];
            if ($elevation[$a] - $elevation[$b] <= 1) {
                $valid[] = $i;
            }
        }
        return $valid;
    }

    private function getNeighbors($x, $y): array
    {
        $directions = [
            'n' => [0, -1],
            's' => [0, +1],
            'e' => [+1, 0],
            'w' => [-1, 0],
        ];
        $neighbors = [];
        foreach ($directions as $k => $v) {
            [$a, $b] = $v;
            $nx = $a + $x;
            $ny = $b + $y;
            if ($nx >= 0 && $ny >= 0
                && array_key_exists($nx, str_split($this->grid[0]))
                && array_key_exists($ny, $this->grid)
            ) {
                $neighbors[$k] = [
                    'key' => "{$nx}-{$ny}",
                    'value' => $this->getCell($nx, $ny)
                ];
            }
        }
        return $neighbors;
    }

    private function getCell($x, $y)
    {
        return $this->grid[$y][$x];
    }

    public function setStart($label): void
    {
        foreach ($this->grid as $r => $row) {
            foreach (str_split($row) as $c => $v) {
                if ($v == $label) {
                    $this->to_search[] = [
                        'key' => "{$c}-{$r}",
                        'value' => $this->getCell($c, $r),
                        'dist' => 0,
                    ];
                    break 2;
                }
            }
        }
    }

}
