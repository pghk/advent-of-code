<?php

namespace App\TwentyTwo;

class Day08
{
    private array $x;
    private array $y;

    public function __construct(public array $input)
    {
        [$this->x, $this->y] = $this->index($input);
    }

    public function partOne(): int
    {
        $trees = [];
        foreach ($this->y as $y => $row) {
            foreach ($row as $x => $_) {
                $trees[] = $this->isVisible($x, $y);
            }
        }

        return count(array_filter($trees, fn($i) => $i));
    }

    public function partTwo(): int
    {
        $scores = [];
        foreach ($this->y as $y => $row) {
            foreach ($row as $x => $_) {
                $scores[] = $this->getScenicScore($x, $y);
            }
        }

        sort($scores);
        return array_reverse($scores)[0];
    }

    private function index($input): array
    {
        $xy = [];
        $yx = [];
        $rows = array_map(fn($i) => str_split($i), array_reverse($input));
        foreach ($rows as $r => $column) {
            foreach ($column as $c => $v) {
                $xy[$c + 1][$r + 1] = $v;
                $yx[$r + 1][$c + 1] = $v;
            }
        }
        return [$xy, $yx];
    }

    private function getScenicScore($x, $y): int
    {
        $fromElevation = $this->x[$x][$y];
        $sightLines = $this->lookOut($x, $y);
        $views = array_map(function ($line) use ($fromElevation) {
            return $this->getLength($line, $fromElevation);
        }, $sightLines);

        return array_reduce($views, fn($a, $i) => $a * $i, 1);
    }

    private function isVisible($x, $y): bool
    {
        $i = $this->x[$x][$y];
        $sightLines = $this->lookOut($x, $y);
        foreach ($sightLines as $line) {
            if (count($line) == 0) {
                return true;
            }
        }
        foreach ($sightLines as $line) {
            $allOpen = true;
            foreach ($line as $a) {
                if ($a >= $i) {
                    $allOpen = false;
                }
            }
            if ($allOpen) {
                return true;
            }
        }
        return false;
    }

    private function lookOut($x, $y): array
    {
        $h = $this->y[$y];
        $v = $this->x[$x];

        $u = array_slice($v, $y);
        $r = array_slice($h, $x);
        $d = array_reverse(array_slice($v, 0, $y - 1));
        $l = array_reverse(array_slice($h, 0, $x - 1));
        return [$u, $r, $d, $l];
    }

    private function getLength(array $line, int $max): int
    {
        $visible = [];
        foreach ($line as $height) {
            $visible[] = $height;
            if ($height < $max) {
                continue;
            }
            break;
        }
        return count($visible);
    }
}
