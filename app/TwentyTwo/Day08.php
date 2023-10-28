<?php

namespace App\TwentyTwo;

class Day08
{
    private array $x = [];
    private array $y = [];

    public function __construct(public array $input)
    {
        $in = array_reverse($input);
        for ($x = 1; $x <= count($in); $x++) {
            $row = str_split($in[$x - 1]);
            for ($y = count($row); $y > 0; $y--) {
                $this->x[$y][$x] = $row[$y - 1];
            }
        }
        for ($x = count($in); $x > 0; $x--) {
            $row = str_split($in[$x - 1]);
            for ($y = 1; $y <= count($row); $y++) {
                $this->y[$x][$y] = $row[$y - 1];
            }
        }
//        print_r(json_encode($this->x) . "\n");
//        print_r(json_encode($this->y) . "\n");
    }

    public function partOne()
    {
        $trees = [];
        foreach ($this->y as $y => $row) {
            foreach ($row as $x => $_) {
//                $yVal = $this->y[$y][$x];
//                $xVal = $this->x[$x][$y];
//                print_r("\nx: {$x}, y: {$y} - ");
//                echo($yVal . "\n");
//                echo($xVal . "\n");
                $vis = $this->isVis($x, $y);
                $trees[] = $vis;
//                var_dump($vis);
            }
        }

        return count(array_filter($trees, fn($i) => $i));
    }

    private function isVis($x, $y)
    {
        $i = $this->x[$x][$y];
        $v = $this->y[$y];
        $h = $this->x[$x];
        $l = array_slice($h, 0, $y - 1);
        $r = array_slice($h, $y);
        $u = array_slice($v, 0, $x - 1);
        $d = array_slice($v, $x);
//        print_r($i . " ");
        foreach ([$l, $r, $u, $d] as $arr) {
//            print_r(json_encode($arr));
            if (count($arr) == 0) {
                return true;
            }
        }
        foreach ([$l, $r, $u, $d] as $arr) {
            $any = true;
            foreach ($arr as $a) {
                if ($a >= $i) {
                    $any = false;
                }
            }
            if ($any) {
                return true;
            }
        }
        return false;
    }


    // public function partTwo()
    // {
    //
    // }
}
