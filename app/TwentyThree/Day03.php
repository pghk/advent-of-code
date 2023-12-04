<?php

namespace App\TwentyThree;

class Day03
{
    public array $partNos;

    private array $grid;

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
        $this->partNos = array_filter($nums, function($v, $k) {
            [$x, $y] = explode('-', $k);
            $span = range($x, intval($x) + strlen($v) - 1);
            $isValid = false;
            foreach($span as $x) {
                if ($this->hasAdjacentSymbol($x, $y)) {
                    $isValid = true;
                    break;
                }
            }
            return $isValid;
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function partOne()
    {
        return array_sum($this->partNos);
    }

    // public function partTwo()
    // {
    //
    // }

    private function hasAdjacentSymbol($x, $y)
    {
        if ($this->isSymbol($this->grid[$x - 1][$y])) {
            return true;
        }
        if ($this->isSymbol($this->grid[$x + 1][$y])) {
            return true;
        }
        if ($this->isSymbol($this->grid[$x][$y - 1])) {
            return true;
        }
        if ($this->isSymbol($this->grid[$x][$y + 1])) {
            return true;
        }
        if ($this->isSymbol($this->grid[$x - 1][$y - 1])) {
           return true;
        }
        if ($this->isSymbol($this->grid[$x + 1][$y + 1])) {
            return true;
        }
        if ($this->isSymbol($this->grid[$x + 1][$y - 1])) {
            return true;
        }
        if ($this->isSymbol($this->grid[$x - 1][$y + 1])) {
            return true;
        }
        return false;
    }

    private function isSymbol($c)
    {
        return $c && $c != "." && !is_numeric($c) && !ctype_alpha($c);
    }
}
