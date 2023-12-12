<?php

namespace App\TwentyThree;

class Day10
{
    const DIRECTIONS = [
        'n' => [0, -1],
        's' => [0, +1],
        'e' => [+1, 0],
        'w' => [-1, 0]
    ];

    private array $grid = [];
    private array $start;
    private array $explored = [];

    public function __construct(public array $input)
    {
        foreach ($this->input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                $p = ($char !== '.') ? new Pipe($char) : null;
                if ($char == 'S') {
                    $this->start = [$x, $y];
                    $p->dist = 0;
                }
                $this->grid[$x][$y] = $p;
            }
        }
    }

    public function partOne(): int
    {
        $to_search = [$this->start];
        $dist = -1;
        while (count($to_search)) {
            $dist++;
            $next = [];
            foreach ($to_search as $i) {
                [$x, $y] = $i;
                $this->explored["{$x}-{$y}"] = true;
                $n = array_filter($this->getNeighbors($x, $y));
                foreach ($n as $dir => $pipe) {
                    $pipe->dist = $dist + 1;
                    [$nx, $ny] = self::DIRECTIONS[$dir];
                    $next[] = [$x + $nx, $y + $ny];
                }
            }
            $to_search = $next;
        }

        return $dist;
    }

    // public function partTwo()
    // {
    //
    // }

    public function getNeighbors($x, $y)
    {
        $neighbors = [];
        $pipe = $this->grid[$x][$y];
        foreach (self::DIRECTIONS as $dir => $coordinates) {
            if ($pipe->dist != 0 && !$pipe->$dir) {
                continue;
            }
            [$rx, $ry] = $coordinates;
            $nx = $x + $rx;
            $ny = $y + $ry;
            if (
                ($nx < 0 || $nx >= count($this->grid)) ||
                ($ny < 0 || $ny >= count($this->grid))
            ) {
                continue;
            }
            if ($this->hasExplored($x + $rx, $y + $ry)) {
                continue;
            }
            /* @var Pipe $neighbor */
            $neighbor = $this->grid[$x + $rx][$y + $ry];
            if (!$neighbor || !$neighbor->isNeighborTo($dir)) {
                continue;
            }
            $neighbors[$dir] = $neighbor;
        }
        return $neighbors;
    }

    public function hasExplored($x, $y)
    {
        return array_key_exists("{$x}-{$y}", $this->explored);
    }

    /**
     * @return void
     */
    public function printMap(): void
    {
        $out = [];
        foreach ($this->grid as $x => $col) {
            foreach ($col as $y => $char) {
                $out[$y][$x] = $char && isset($char->dist) ? $char->dist : ".";
            }
        }
        print("\n");
        foreach ($out as $row) {
            print implode("", $row) . "\n";
        }
    }
}

class Pipe
{
    public bool $n = false;
    public bool $s = false;
    public bool $e = false;
    public bool $w = false;

    public int $dist;

    public function __construct(string $def)
    {
        switch ($def) {
            case '|':
                $this->n = true;
                $this->s = true;
                break;
            case '-':
                $this->e = true;
                $this->w = true;
                break;
            case 'L':
                $this->n = true;
                $this->e = true;
                break;
            case '7':
                $this->w = true;
                $this->s = true;
                break;
            case 'J':
                $this->n = true;
                $this->w = true;
                break;
            case 'F':
                $this->e = true;
                $this->s = true;
                break;
        }
    }

    public function hasBeenChecked()
    {
        return isset($this->dist);
    }

    public function isNeighborTo($dir)
    {
        return match ($dir) {
            's' => $this->n,
            'n' => $this->s,
            'w' => $this->e,
            'e' => $this->w,
        };
    }

}
