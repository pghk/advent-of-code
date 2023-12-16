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

    public function partTwo()
    {
        $count = 0;
        $this->partOne();
        foreach ($this->grid as $x => $col) {
            foreach ($col as $y => $cell) {
                if (!$cell instanceof Pipe || !isset($cell->dist)) {
                    if ($this->isEnclosed($x, $y)) {
                        $count++;
                    }
                }
            }
        }
//        $this->drawMap();
        return $count;
    }

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

    public function drawMap(): void
    {
        $out = [];
        foreach ($this->grid as $x => $col) {
            foreach ($col as $y => $cell) {
                $out[$y][$x] = $cell ? $cell->glyph() : "·";
            }
        }
        print("\n");
        foreach ($out as $row) {
            print implode("", $row) . "\n";
        }
    }

    private function isEnclosed($x, $y): bool
    {
        $count = $this->countIntersects($x, $y) % 2 != 0;
        return $count % 2 != 0;
    }

    private function countIntersects($x, $y)
    {
        return min(
            $this->countLongIntersects($x, $y),
            $this->countLatIntersects($x, $y)
        );
    }

    private function countLatIntersects($x, $y): int
    {
        $max = count($this->grid[0]) - 1;

        $counts = ['north' => 0, 'south' => 0];
        foreach (['north' => -1, 'south' => 1] as $k => $v) {
            $pos = $y;
            $east_halves = 0;
            $west_halves = 0;
            while ($pos >= 0 && $pos <= $max) {
                $cell = $this->grid[$x][$pos];
                if ($cell instanceof Pipe && isset($cell->dist)) {
                    if ($cell->e) {
                        $east_halves++;
                    }
                    if ($cell->w) {
                        $west_halves++;
                    }
                }
                $pos = $pos + $v;
            }
            $counts[$k] = min($east_halves, $west_halves);
        }
        return (min($counts['north'], $counts['south']));
    }

    private function countLongIntersects($x, $y): int
    {
        $max = count($this->grid) - 1;

        $counts = ['west' => 0, 'east' => 0];
        foreach (['west' => -1, 'east' => 1] as $k => $v) {
            $pos = $x;
            $north_halves = 0;
            $south_halves = 0;
            while ($pos >= 0 && $pos <= $max) {
                $cell = $this->grid[$pos][$y];
                if ($cell instanceof Pipe && isset($cell->dist)) {
                    if ($cell->n) {
                        $north_halves++;
                    }
                    if ($cell->s) {
                        $south_halves++;
                    }
                }
                $pos = $pos + $v;
            }
            $counts[$k] = min($north_halves, $south_halves);
        }
        return (min($counts['west'], $counts['east']));
    }
}

class Pipe
{
    public bool $n = false;
    public bool $s = false;
    public bool $e = false;
    public bool $w = false;
    public array $glyphs = ['·'];

    public int $dist;

    public function __construct(string $def)
    {
        switch ($def) {
            case '|':
                $this->n = true;
                $this->s = true;
                $this->glyphs = ['║', '│'];
                break;
            case '-':
                $this->e = true;
                $this->w = true;
                $this->glyphs = ['═', '─'];
                break;
            case 'L':
                $this->n = true;
                $this->e = true;
                $this->glyphs = ['╚', '└'];
                break;
            case '7':
                $this->w = true;
                $this->s = true;
                $this->glyphs = ['╗', '┐'];
                break;
            case 'J':
                $this->n = true;
                $this->w = true;
                $this->glyphs = ['╝', '┘'];
                break;
            case 'F':
                $this->e = true;
                $this->s = true;
                $this->glyphs = ['╔', '┌'];
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

    public function glyph()
    {
        return isset($this->dist) ? $this->glyphs[0] : $this->glyphs[1];
    }

}
