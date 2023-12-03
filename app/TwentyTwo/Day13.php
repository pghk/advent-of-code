<?php

namespace App\TwentyTwo;

use phpDocumentor\Reflection\Type;

class Day13
{
    private array $pairs;
    public function __construct(public array $input)
    {

    }

    public function partOne()
    {
        $this->pairs = array_map(
            fn ($i) => array_map(
                fn ($j) => json_decode($j),
                explode("\n", $i)
            ),
            $this->input
        );
        $correctlyOrdered = [];
        foreach($this->pairs as $i => $pair) {
            [$a, $b] = $pair;
            [$c, $d] = $pair;
            if($this->compareLists($a, $b) == -1) {
//                print("correct: " . json_encode($c) . " vs " . json_encode($d) . "\n");
                $correctlyOrdered[] = $i + 1;
            } else {
//                print("incorrect: " . json_encode($c) . " vs " . json_encode($d) . "\n");
            }
        }
//        return join(', ', $correctlyOrdered);
        return array_sum($correctlyOrdered);
    }

     public function partTwo()
     {
         $packets = array_map(
             fn($j) => json_decode($j),
             array_filter(
                 $this->input, fn($i) => strlen($i)
             )
         );
         $packets[] = [[2]];
         $packets[] = [[6]];
         usort($packets, function ($a, $b) {
             return $this->compareLists($a, $b);
         });
         print(json_encode((object)$packets) . "\n\n");
         $divA = array_search([[2]], $packets);
         $divB = array_search([[6]], $packets);
         print($divA . "\n");
         print($divB . "\n");
         return ($divA + 1) * ($divB + 1);
     }


    private function compareLists(&$one, &$two)
    {
//        print("comparing lists: " . json_encode($one) . " & " . json_encode($two) . "\n");
        if (count($two) && !count($one)) {
            return -1;
        }
        if (count($one) && !count($two)) {
            return 1;
        }
        if (!count($one) && !count($two)) {
            return 0;
        }

        $a = array_shift($one);
        $b = array_shift($two);

        $delta = null;

        if (gettype($a) == 'array' && gettype($b) == 'array') {
//            print("lists: " . json_encode([$a, $b]) . "\n");
            $delta = $this->compareLists($a, $b);
        }
        if ($delta === 0) {
            return $this->compareLists($one, $two);
        }
        if ((gettype($a) == 'integer' && gettype($b) == 'integer') || (gettype($a) == 'integer' && $b === null) || (gettype($a) == 'integer' && $b === null)) {
//            print("ints: " . json_encode([$a, $b]) . "\n");
            $delta = $this->compareIntegers($a, $b);
        }
        if ($delta === 0) {
            return $this->compareLists($one, $two);
        }
        if ($delta === null) {
            [$a, $b] = $this->normalize($a, $b);
            return $this->compareLists($a, $b);
        }

//        print("delta {$delta}: " . json_encode([$a, $b]) . "\n");


        return $delta;
    }

    private function compareIntegers($a, $b): int
    {
//        print("comparing ints: " . json_encode($a) . " & " .json_encode($b) . "\n");
       if ($a == $b) {
           return 0;
       }
       return ($a < $b) ? -1 : 1;
    }

    private function normalize($a, $b): array
    {
//        print("normalizing " . json_encode($a) . " & " . json_encode($b) . "\n");
        if (gettype($a) == gettype($b)) {
            return [$a, $b];
        }
        return match (gettype($a)) {
            'integer' => [[$a], $b],
            'array' => [$a, [$b]],
        };
    }
}
