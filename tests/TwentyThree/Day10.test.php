<?php

use App\TwentyThree\Day10;

const EXAMPLE_10a = <<<txt
    .....
    .S-7.
    .|.|.
    .L-J.
    .....
    txt;

test('Part One: Example A', function () {
    $input = explode("\n", EXAMPLE_10a);
    $sys = new Day10($input);
    expect($sys->partOne())->toBe(4);
});

const EXAMPLE_10b = <<<txt
    -L|F7
    7S-7|
    L|7||
    -L-J|
    L|-JF
    txt;

test('Part One: Example B', function () {
    $input = explode("\n", EXAMPLE_10b);
    $sys = new Day10($input);
    expect($sys->partOne())->toBe(4);
});

const EXAMPLE_10c = <<<txt
    7-F7-
    .FJ|7
    SJLL7
    |F--J
    LJ.LJ
    txt;

test('Part One: Example C', function () {
    $input = explode("\n", EXAMPLE_10c);
    $sys = new Day10($input);
    expect($sys->partOne())->toBe(8);
});

 test('Part One: Puzzle', function () {
     $input = file(at('TwentyThree/10.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day10($input);
     expect($sys->partOne())->toBe(6828);
 });

// test('Part Two: Example', function () {
//     $input = explode("\n", EXAMPLE_10);
//     $sys = new Day10($input);
//     expect($sys->partTwo())->toBe(0);
// });
//
// test('Part Two: Puzzle', function () {
//     $input = file(at('TwentyThree/10.txt'), FILE_IGNORE_NEW_LINES);
//     $sys = new Day10($input);
//     expect($sys->partTwo())->toBe(0);
// });
