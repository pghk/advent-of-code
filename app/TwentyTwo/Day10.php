<?php

namespace App\TwentyTwo;

class Day10
{
    private array $cycles = [['x' => 1]];

    public function __construct(public array $input)
    {
        $c = 0;
        foreach ($input as $i) {
            $this->cycles[] = $this->cycles[$c];
            $c++;
            if ($i == 'noop') {
                continue;
            }
            $v = (int)explode(' ', $i)[1];
            $this->cycles[] = ['x' => $this->cycles[$c]['x'] + $v];
            $c++;
        }
        array_pop($this->cycles);
    }

    public function partOne()
    {
        return array_sum([
            $this->getSignal(20),
            $this->getSignal(60),
            $this->getSignal(100),
            $this->getSignal(140),
            $this->getSignal(180),
            $this->getSignal(220)
        ]);
    }

    private function getSignal($n)
    {
        return $this->cycles[$n - 1]['x'] * $n;
    }

    public function partTwo(): string
    {
        return $this->paint();
    }

    private function paint(): string
    {
        $rows = array_chunk($this->cycles, 40);
        $screen = array_map(fn($r) => static::printRow($r), $rows);
        return join("\n", $screen);
    }

    private static function printRow(array $cycles): string
    {
        $row = "";
        foreach ($cycles as $i => $c) {
            $row .= static::draw($i, $c['x']);
        }
        return $row;
    }

    private static function draw($pixel, $pos): string
    {
        $sprite = range($pos - 1, $pos + 1);
        return in_array($pixel, $sprite) ? "#" : '.';
    }

}
