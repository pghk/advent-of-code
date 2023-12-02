<?php

namespace App\TwentyThree;

class Day01
{
    private array $numbers;
    public function __construct(public array $input)
    {
           $this->numbers = array_map(function ($i) {
               return preg_replace('/[[:alpha:]]/i', '', $i);
           }, $input);
    }

    public function partOne()
    {
        $filtered = array_map(function($i) {
           $n = join('', [$i[0], $i[-1]]);
           return intval($n);
        }, $this->numbers);
        return array_sum($filtered);
    }

    // public function partTwo()
    // {
    //
    // }
}
