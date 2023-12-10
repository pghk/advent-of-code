<?php

namespace App\TwentyThree;

class Day06
{
    private array $races;

    public function __construct(public array $input)
    {
        [$times, $distances] = array_map(function ($line) {
            [$label, $data] = explode(':', $line);
            return preg_split('/\s+/', $data, null, 1);
        }, $input);
        for ($i = 0; $i < count($times); $i++) {
           $this->races[] =  [
               'time_limit' => $times[$i],
               'dist_record' => $distances[$i]];
        }
    }

    public function partOne()
    {
        $results = [];
        foreach ($this->races as $race) {
            $mid = intval(floor($race['time_limit'] / 2));
            for ($i = $mid; $i > 0; $i--) {
                if (($race['time_limit'] - $i) * $i > $race['dist_record']) {
                    continue;
                }
                $results[] = ($race['time_limit'] - ($i + 1)) - $i;
                break;
            }
        }

        return array_product($results);
    }

    // public function partTwo()
    // {
    //
    // }
}
