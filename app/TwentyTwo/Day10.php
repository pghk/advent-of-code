<?php

namespace App\TwentyTwo;

class Day10
{
    private array $cycles = [
        1 => ['X' => 1],
    ];

    public function __construct(public array $input)
    {
        $c = 1;
        foreach ($input as $i) {
            $this->cycles[] = $this->cycles[$c];
            $c++;
            if ($i == 'noop') {
                continue;
            }
            $v = (int)explode(' ', $i)[1];
            $this->cycles[] = ['X' => $this->cycles[$c]['X'] + $v];
            $c++;
        }
        array_pop($this->cycles);
    }

    public function partOne()
    {
        return array_sum([
            $this->cycles[20]['X'] * 20,
            $this->cycles[60]['X'] * 60,
            $this->cycles[100]['X'] * 100,
            $this->cycles[140]['X'] * 140,
            $this->cycles[180]['X'] * 180,
            $this->cycles[220]['X'] * 220,
        ]);
    }

    public function partTwo(): string
    {
        return $this->paint();
    }

    private function paint(): string
    {
        $rows = [];
        $i = 0;
        while ($i < count($this->cycles)) {
            $rows[] = array_combine(
                range($i + 1, $i + 40),
                array_slice($this->cycles, $i, 40, true)
            );
            $i += 40;
        }
        $screen = array_map(fn($r) => static::printRow($r), $rows);
        return join("\n", $screen);
    }

    private static function printRow(array $cycles): string
    {
        $row = [];
        foreach ($cycles as $i => $c) {
            # cycles 1-40 operate on positions 0-39, then wrap around
            $p = (($i - 1) + 40) % 40;
            $row[] = static::draw($p, $c['X']);
        }
        return join("", $row);
    }

    private static function draw($s, $p): string
    {
        return in_array($s, range($p - 1, $p + 1)) ? "#" : '.';
    }

}
