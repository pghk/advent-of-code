<?php

use App\TwentyTwo\Day12;

const EXAMPLE_12 = <<<txt
    Sabqponm
    abcryxxl
    accszExk
    acctuvwj
    abdefghi
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_12);
    $sys = new Day12($input);
    expect($sys->partOne())->toBe(31);
});

 test('Part One: Puzzle', function () {
     $input = file(at('TwentyTwo/12.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day12($input);
     expect($sys->partOne())->toBe(456);
 });

// test('Part Two: Example', function () {
//     $input = explode("\n", EXAMPLE_12);
//     $sys = new Day12($input);
//     expect($sys->partTwo())->toBe(0);
// });
//
// test('Part Two: Puzzle', function () {
//     $input = file(at('TwentyTwo/12.txt'), FILE_IGNORE_NEW_LINES);
//     $sys = new Day12($input);
//     expect($sys->partTwo())->toBe(0);
// });
