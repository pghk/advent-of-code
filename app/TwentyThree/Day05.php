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
    }

    public function partTwo()
    {
        $locations = [];
        while (count($this->seeds)) {
            [$start, $length] = array_splice($this->seeds, 0, 2);
            $locations = array_merge($locations, $this->followRange(intval($start), intval($length)));
        }
        sort($locations);
        return $locations[0];
    }

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
        $fertile = $this->maps[1]->resolve($soil);
        $water = $this->maps[2]->resolve($fertile);
        $light = $this->maps[3]->resolve($water);
        $temp = $this->maps[4]->resolve($light);
        $humid = $this->maps[5]->resolve($temp);
        $loc = $this->maps[6]->resolve($humid);
        return $loc;
    }

    public function followRange($start, $length): mixed
    {
        $ranges = [[$start, $start + $length - 1]];
        foreach ($this->maps as $m) {
            $next = [];
            foreach ($ranges as $r) {
                [$low, $high] = $r;
                $resolved = $m->resolveRange($low, $high);
                foreach ($resolved as $res) {
                    $next[] = $res;
                }
            }
            $ranges = $next;
        }
        return array_filter(array_column($ranges, 0));
    }


}

class Map
{
    public string $type;
    public array $rangeList;
    private array $columns;

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
        $this->rangeList = array_map(fn($sm) => ["input" => $sm->inputRange, "output" => $sm->outputRange],
            $this->subMaps);
    }

    public function resolve($x)
    {
        return $this->findMiniMap($x, range(0, $this->subMapCount - 1));
    }

    public function resolveRange($low, $high)
    {
        $next_map = [];
        foreach ($this->subMaps as $i => $m) {
            $resolved = $m->resolveRange($low, $high);
            foreach ($resolved as $k => $v) {
                if ($k === 'within' || $this->type == "humidity-location") {
                    $next_map[] = $v;
                }
            }
            if ($i === $this->subMapCount - 1 && empty($next_map)) {
                $next_map = array_values($resolved);
            }
        }
        return $next_map;
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
    public array $inputRange;
    public array $outputRange;

    public function __construct(
        public int $dest,
        public int $source,
        public int $length
    ) {
        $this->min = $this->source;
        $this->max = $this->source + $this->length - 1;
        $this->inputRange = [$this->source, $this->source + $this->length - 1];
        $this->outputRange = [$this->dest, $this->dest + $this->length - 1];
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

    public function resolveRange($low, $high)
    {
        $min = $this->min;
        $max = $this->max;

        $under = null;
        $within = null;
        $over = null;

        if ($high < $min || $low > $max) {
            return ['outside' => [$low, $high]];
        }

        if ($low < $min) {
            $under = [$low, $min - 1];
        }
        if ($high > $max) {
            $over = [$max + 1, $high];
        }

        if ($low < $min && $high <= $max) {
            $within = [$min, $high];
        }
        if ($low < $min && $high > $max) {
            $within = [$min, $max];
        }
        if ($low >= $min && $high <= $max) {
            $within = [$low, $high];
        }
        if ($low >= $min && $high > $max) {
            $within = [$low, $max];
        }
        if ($within) {
            $within = array_map(fn($x) => $x - $this->source + $this->dest, $within);
        }


        return array_filter(['under' => $under, 'within' => $within, 'over' => $over]);
    }
}
