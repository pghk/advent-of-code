<?php

use App\TwentyThree\Day09;

const EXAMPLE_09 = <<<txt
    0 3 6 9 12 15
    1 3 6 10 15 21
    10 13 16 21 30 45
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_09);
    $sys = new Day09($input);
    expect($sys->partOne())->toBe(114);
});

test('Part One: Puzzle', function () {
    $input = file(at('TwentyThree/09.txt'), FILE_IGNORE_NEW_LINES);
    $sys = new Day09($input);
    expect($sys->partOne())->toBe(1974232246);
});

test('Part Two: Example', function () {
    $input = explode("\n", EXAMPLE_09);
    $sys = new Day09($input);
    expect($sys->partTwo())->toBe(2);
});

test('Part Two: Puzzle', function () {
    $input = file(at('TwentyThree/09.txt'), FILE_IGNORE_NEW_LINES);
    $sys = new Day09($input);
    expect($sys->partTwo())->toBe(928);
});
