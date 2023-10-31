<?php

use App\TwentyTwo\Day09;

const EXAMPLE_09 = <<<txt
    R 4
    U 4
    L 3
    D 1
    R 4
    D 1
    L 5
    R 2
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_09);
    $sys = new Day09();
    expect($sys->partOne($input))->toBe(13);
});

test('Part One: Puzzle', function () {
    $input = file(at('TwentyTwo/09.txt'), FILE_IGNORE_NEW_LINES);
    $sys = new Day09();
    expect($sys->partOne($input))->toBe(6087);
});


// test('Part Two: Example', function () {
//     $input = explode("\n", EXAMPLE_09);
//     $sys = new Day09($input);
//     expect($sys->partTwo())->toBe(0);
// });
//
// test('Part Two: Puzzle', function () {
//     $input = file(at('TwentyTwo/09.txt'), FILE_IGNORE_NEW_LINES);
//     $sys = new Day09($input);
//     expect($sys->partTwo())->toBe(0);
// });
