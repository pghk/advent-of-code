<?php

namespace App\TwentyThree;

class Day06
{
    private array $races;
    private array $race;

    public function __construct(public array $input)
    {
        [$times, $distances] = array_map(function ($line) {
            [$label, $data] = explode(':', $line);
            return preg_split('/\s+/', $data, null, 1);
        }, $input);
        for ($i = 0; $i < count($times); $i++) {
            $this->races[] = [
                'time_limit' => $times[$i],
                'dist_record' => $distances[$i]
            ];
        }
        $one_time = join($times);
        $one_dist = join($distances);
        $this->race = [$one_time, $one_dist];
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
                $results[] = $race['time_limit'] - 1 - ($i * 2);
                break;
            }
        }

        return array_product($results);
    }

     public function partTwo()
     {
         $result = null;
         [$t, $d] = $this->race;
         $mid = intval(floor($t / 2));
         for ($i = $mid; $i > 0; $i--) {
             if (($t - $i) * $i > $d) {
                 continue;
             }
             $result = $t - 1 - ($i * 2);
             break;
         }
         return $result;
     }
}
