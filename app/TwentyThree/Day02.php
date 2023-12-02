<?php

namespace App\TwentyThree;

class Day02
{
    private $games;

    public function __construct(public array $input)
    {
       $this->games = $this->parse($input);
    }

    public function partOne()
    {
        $limits = [
            "red" => 12,
            "green" => 13,
            "blue" => 14,
        ];

        $possibleGames = [];

        foreach ($this->games as $g) {
            $possible = true;
            $i = 0;
            while ($possible && $i < count($g->sets)) {
                $set = $g->sets[$i];
                foreach ($limits as $color => $max) {
                    if ($set->$color > $max) {
                        $possible = false;
                        break;
                    }
                }
                $i++;
            }
            if ($possible) {
                $possibleGames[] = $g->id;
            }
        }

        return array_sum($possibleGames);
    }

     public function partTwo()
     {
         $powers = [];

         foreach ($this->games as $g) {
            $minis = [
                'red' => 0,
                'green' => 0,
                'blue' => 0,
            ];
            foreach ($g->sets as $set) {
                foreach ($minis as $color => $count) {
                    if ($set->$color > $count) {
                        $minis[$color] = $set->$color;
                    }
                }
            }
            $powers[] = $minis['red'] * $minis['green'] * $minis['blue'];
         }

         return array_sum($powers);
     }

    private function parse(array $defs)
    {
        return array_map(fn ($d) => new Game($d), $defs);
    }
}

class Game {

    public int $id;
    public array $sets;

    public function __construct($def)
    {
        [$name, $data] = explode(': ', $def);
        $this->id = intval(str_replace('Game ', '', $name));
        $this->sets = array_map(fn ($d) => new Set($d), explode('; ', $data));
    }
}

class Set {
    public int $red = 0;
    public int $green = 0;
    public int $blue = 0;

    public function __construct(string $def)
    {
        foreach (explode(', ', $def) as $cube) {
            [$size, $color] = explode(' ', $cube);
            $this->$color = $size;
        }
    }
}
