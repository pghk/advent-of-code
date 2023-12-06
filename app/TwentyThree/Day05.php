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
        $locations = array_map(fn($s) => $this->follow($s), $this->seeds);
        sort($locations);
        return $locations[0];
//        return $this->maps[0]->resolve(101);
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
        $soil = $this->maps[0]->resolve($seed);
        print("soil: " . $soil . "\n");
        $fertile = $this->maps[1]->resolve($soil);
        print("fertile: " . $fertile . "\n");
        $water = $this->maps[2]->resolve($fertile);
        print("water: " . $water. "\n");
        $light = $this->maps[3]->resolve($water);
        print("light: " . $light . "\n");
        $temp = $this->maps[4]->resolve($light);
        print("temp: " . $temp . "\n");
        $humid = $this->maps[5]->resolve($temp);
        print("humid: " . $humid . "\n");
        $loc = $this->maps[6]->resolve($humid);
        print("loc: " . $loc . "\n");
        return $loc;
    }


}

class Map
{
    public string $type;
    private array $columns;
    private array $map;

    /**
     * @var MiniMap[]
     */
    private array $subMaps = [];
    private int $subMapCount = 0;
    private $limit = 0;

    public function __construct(string $def)
    {
        $data = explode("\n", $def);
        [$type, $_] = explode(' ', array_shift($data));
        $this->columns = explode('-to-', $type);
        $this->type = join('-', $this->columns);

        foreach ($data as $line) {
            [$a, $b, $n] = array_map(fn($s) => intval($s), explode(' ', $line));
            $this->subMaps[] = new MiniMap($a, $b, $n);
            $this->subMapCount++;
        }
        usort($this->subMaps, function ($a, $b) {
            if ($a->min == $b->min) {
                return 0;
            };
            return $a->min < $b->min ? -1 : 1;
        });
    }

    public function resolve($x)
    {
       return $this->findMiniMap($x, range(0, $this->subMapCount - 1));
    }

    private function findMiniMap(int $x, array $options)
    {
//        if ($this->limit > 50) {
//            return null;
//        }
        print(json_encode([$x, $options]) . "\n");
        $this->limit++;
        if (empty($options)) {
            return $x;
        }
        if (count($options) == 1) {
            $miniMap = $this->subMaps[end($options)];
            print("last option: {$options[0]} \n");
            if ($miniMap->compare($x) == 0) {
               return $miniMap->resolve($x);
            }
            return $x;
        }
        $mid = ceil(count($options) / 2);
        $miniMap = $this->subMaps[$mid];
        print("checking option {$mid} \n");
        $next = match ($miniMap->compare($x)) {
            -1 => array_slice($options, 0, $mid),
            1 => array_slice($options, $mid),
            0 => [$mid]
        };
        return $this->findMiniMap($x, $next);
    }

}

class MiniMap
{
    public int $min;
    public int $max;

    public function __construct(
        public int $dest,
        public int $source,
        public int $length
    )
    {
        $this->min = $this->source;
        $this->max = $this->source + $this->length - 1;
    }

    public function compare($n): int
    {
        if ($n < $this->source) {
            print("less" . "\n");
            return -1;
        }
        if ($n > $this->max) {
            print("more" . "\n");
            return 1;
        }
        print("same" . "\n");
        return 0;
    }

    public function resolve($x): int
    {
        print(json_encode([$x, $this->source, $this->dest]) . "\n");
        return ($x - $this->source) + $this->dest;
    }
}
