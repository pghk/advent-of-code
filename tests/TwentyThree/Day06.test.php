<?php

use App\TwentyThree\Day06;

const EXAMPLE_06 = <<<txt
    Time:      7  15   30
    Distance:  9  40  200
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_06);
    $sys = new Day06($input);
    expect($sys->partOne())->toBe(288);
});

test('Part One: Puzzle', function () {
    $input = file(at('TwentyThree/06.txt'), FILE_IGNORE_NEW_LINES);
    $sys = new Day06($input);
    expect($sys->partOne())->toBe(1083852);
});

test('Part Two: Example', function () {
    $input = explode("\n", EXAMPLE_06);
    $sys = new Day06($input);
    expect($sys->partTwo())->toBe(71503);
});

test('Part Two: Puzzle', function () {
    $input = file(at('TwentyThree/06.txt'), FILE_IGNORE_NEW_LINES);
    $sys = new Day06($input);
    expect($sys->partTwo())->toBe(23501589);
});
