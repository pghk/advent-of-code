<?php

use App\TwentyThree\Day06;

const EXAMPLE_06 = <<<txt
    Time:      7  15   30
    Distance:  9  40  200
    txt;

// 17, 40 - 17 = 23, 23 * 18 = 391
// 18, 40 - 18 = 22, 22 * 18 = 396
// 19, 40 - 19 = 21, 21 * 19 = 399
// 20, 40 - 20 = 20, 20 * 20 = 400
// 21, 40 - 21 = 19, 19 * 21 = 399

// 3, 15 - 3 = 12, 12 * 3 = 36
// 4, 15 - 4 = 11, 11 * 4 = 44
// 5, 15 - 5 = 10, 10 * 5 = 50
// 6, 15 - 6 = 9, 9 * 6 = 54
// 7, 15 - 7 = 8, 8 * 7 = 56
// 8, 15 - 8 = 7, 7 * 8 = 56
// 9, 15 - 9 = 6, 6 * 9 = 54
// 10, 15 - 10 = 5, 5 * 10 = 50
// 11, 15 - 11 = 4, 4 * 11 = 44
// 12, 15 - 12 = 3, 3 * 12 = 36

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

// test('Part Two: Example', function () {
//     $input = explode("\n", EXAMPLE_06);
//     $sys = new Day06($input);
//     expect($sys->partTwo())->toBe(0);
// });
//
// test('Part Two: Puzzle', function () {
//     $input = file(at('TwentyThree/06.txt'), FILE_IGNORE_NEW_LINES);
//     $sys = new Day06($input);
//     expect($sys->partTwo())->toBe(0);
// });
