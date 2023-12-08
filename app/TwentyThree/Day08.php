<?php

namespace App\TwentyThree;

class Day08
{
    /**
     * @var string[]
     */
    private array $instructions;

    /**
     * @var string[]
     */
    private array $map;

    public function __construct(public array $input)
    {
        $this->instructions = str_split($input[0]);
        $ids = [];
        $dirs = [];
        foreach(array_slice($this->input, 2) as $line) {
            [$id, $dir] = explode(' = ', $line);
            $ids[] = $id;
            $dirs[] = array_combine(
                ['L', 'R'],
                explode(', ', substr($dir, 1, -1))
            );
        };
        $this->map = array_combine($ids, $dirs);
    }

    public function partOne()
    {
        $steps = 0;
        $pos = 'AAA';
        while ($pos !== 'ZZZ') {
            foreach ($this->instructions as $i) {
                $pos = $this->map[$pos][$i];
                $steps++;
            }
        }
        return $steps;
    }

    // public function partTwo()
    // {
    //
    // }
}
