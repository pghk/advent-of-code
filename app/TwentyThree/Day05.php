<?php

namespace App\TwentyThree;

class Day05
{
    public array $maps;
    public array $seeds;

    public function __construct(public array $input)
    {
        $data = $input;
        $this->seeds = static::parseSeeds(array_shift($data));
        $this->maps = static::parseMaps($data);
    }

    public function partOne()
    {
        $locations = array_map(fn ($s) => $this->follow($s), $this->seeds);
        sort($locations);
        return $locations[0];
    }

    // public function partTwo()
    // {
    //
    // }

    private static function parseSeeds(string $line): array
    {
        [$name, $nums] = explode(': ', $line);
        return explode(' ', $nums);
    }

    private static function parseMaps(array $data)
    {
        $maps = array_map(fn($s) => new Map($s), $data);
        return $maps;
    }

    public function follow($seed): mixed
    {
        $s = $this->maps[0]->get($seed);
        $f = $this->maps[1]->get($s);
        $w = $this->maps[2]->get($f);
        $l = $this->maps[3]->get($w);
        $t = $this->maps[4]->get($l);
        $h = $this->maps[5]->get($t);
        $l = $this->maps[6]->get($h);

        return $l;
    }

}

class Map
{
    public string $type;
    private array $columns;
    private array $map;

    public function __construct(string $def)
    {
        $data = explode("\n", $def);
        [$type, $_] = explode(' ', array_shift($data));
        $this->columns = explode('-to-', $type);
        $this->type = join('-', $this->columns);

        $nums = array_map(function ($x) {
            [$a, $b, $n] = explode(' ', $x);
            return [
                $this->columns[0] => range($a, intval($a) + intval($n) - 1),
                $this->columns[1] => range($b, intval($b) + intval($n) - 1),
            ];
        }, $data);

        $parts = array_map(function ($p) {
            return array_combine(
                $p[$this->columns[1]],
                $p[$this->columns[0]],
            );
        }, $nums);

        $data = [];
        foreach($parts as $p) {
            $data = $data + $p;
        }
        $this->map = $data;
    }

    public function get($s)
    {
       return $this->map[$s] ?? $s;
    }
}
