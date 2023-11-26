<?php

namespace App\TwentyTwo;

class Day12
{
    private array $grid;
    private array $to_search = [];
    private array $search_history = [];
    private int $search_depth = 0;
    private array $start;
    private int $limit = 0;

    public function __construct(public array $input)
    {
        $this->grid = $input;
        foreach ($input as $r => $row) {
            foreach (str_split($row) as $c => $v) {
                if ($v == 'S') {
                    $this->to_search[] = [
                        'key' => "{$c}-{$r}",
                        'value' => $this->getCell($c, $r),
                        'dist' => 0,
                    ];
                    break 2;
                }
            }
        }
//        print(json_encode($this->start));
    }

    public function partOne()
    {
        return $this->search();
    }

    // public function partTwo()
    // {
    //
    // }

    private function search()
    {
        $is_found = false;
//        print("starting here: " . json_encode($this->to_search) . "\n");
        while ($is_found == false && count($this->to_search) > 0 && $this->limit <= 10) {
            $i = array_shift($this->to_search);
            if (array_key_exists($i['key'], $this->search_history)) {
                continue;
            }
            $this->search_history[$i['key']] = true;
//            print("searching: " . json_encode($i) . "\n");
            $is_found = $this->reviewPaths($i);
//            $this->limit++;
        }
        return array_reverse($this->to_search)[0]['dist'];
    }

    private function reviewPaths($start)
    {
        $depth = $start['dist'];
//        print("parent: " . json_encode($start) . "\n");
        $next = $this->chartPaths($start['key']);
        $is_found = false;
        foreach ($next as $path) {
            if ($path['value'] == 'E') {
                $is_found = true;
                break;
            }
            $path['dist'] = $depth + 1;
            $this->to_search[] = $path;
        }
        return $is_found;
    }

    private function chartPaths($key)
    {
        [$x, $y] = array_map(fn($i) => intval($i), explode('-', $key));
//        var_dump(explode('-', $key));
        $valid = [];
        $elevation = array_merge(
            ['S' => 1, 'E' => 26],
            array_combine(range("a", "z"), range(1, 26))
        );
        $a = $this->getCell($x, $y);
        foreach ($this->getNeighbors($x, $y) as $n => $i) {
            $b = $i['value'];
            if ($elevation[$b] - $elevation[$a] <= 1) {
                $valid[] = $i;
            }
        }
        return $valid;
    }

    private function getNeighbors($x, $y)
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

}
