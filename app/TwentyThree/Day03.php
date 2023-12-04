<?php

namespace App\TwentyThree;

class Day03
{
    public array $partNums;
    public array $gearRatios;

    private array $grid;
    private array $gears = [];

    public function __construct(public array $input)
    {
        $nums = [];

        foreach ($this->input as $row => $line) {
            $buff = [];
            $y = strlen($line) - $row;
            foreach (str_split($line) as $col => $char) {
                $x = $col + 1;
                $this->grid[$x][$y] = $char;
                if (is_numeric($char)) {
                    $buff[] = $char;
                }
                if (is_numeric($char) && $x == strlen($line)) {
                    if (count($buff)) {
                        $nx = $x - count($buff) + 1;
                        $nums["{$nx}-{$y}"] = join('', $buff);
                        $buff = [];
                    }
                }
                if (!is_numeric($char)) {
                    if (count($buff)) {
                        $nx = $x - count($buff);
                        $nums["{$nx}-{$y}"] = join('', $buff);
                        $buff = [];
                    }
                }
            }
        }

        $this->partNums = array_filter($nums, function($v, $k) {
            [$x, $y] = explode('-', $k);
            $span = range($x, intval($x) + strlen($v) - 1);
            $isValid = false;
            foreach($span as $x) {
                [$s, $sx, $sy] = $this->getAdjacentSymbol($x, $y);
                if ($s == "*") {
                    $this->gears["{$sx}-{$sy}"][] = $v;
                }
                if ($s) {
                    $isValid = true;
                    break;
                }
            }
            return $isValid;
        }, ARRAY_FILTER_USE_BOTH);

        $this->gears = array_filter($this->gears, function($v) {
           return count($v) == 2;
        });
    }

    public function partOne()
    {

        return array_sum($this->partNums);
    }

     public function partTwo()
     {
         $ratios = [];
         foreach ($this->gears as $g) {
             [$a, $b] = $g;
             $ratios[] = $a * $b;
         }
         return array_sum($ratios);
     }

    private function getAdjacentSymbol($x, $y)
    {
        $dirs = ['U', 'R', 'D', 'L', 'LU', 'RU', 'RD', 'LD'];
        foreach ($dirs as $dir) {
            [$c, $nx, $ny] = $this->checkNeighbor($x, $y, $dir);
            if ($this->isSymbol($c)) {
               return [$c, $nx, $ny];
            }
        }

        return [];
    }

    private function isSymbol($c)
    {
        return $c && $c != "." && !is_numeric($c) && !ctype_alpha($c);
    }

    private function checkNeighbor($x, $y, $dir)
    {
        [$nx, $ny] = match($dir) {
            'U' => [$x, $y + 1],
            'R' => [$x + 1, $y],
            'D' => [$x, $y - 1],
            'L' => [$x - 1, $y],
            'LU' => [$x - 1, $y + 1],
            'RU' => [$x + 1, $y + 1],
            'RD' => [$x + 1, $y - 1],
            'LD' => [$x - 1, $y - 1],
        };
        return [$this->grid[$nx][$ny], $nx, $ny];
    }
}
