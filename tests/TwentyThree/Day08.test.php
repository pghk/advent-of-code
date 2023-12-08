<?php

use App\TwentyThree\Day08;

const EXAMPLE_08a = <<<txt
    RL

    AAA = (BBB, CCC)
    BBB = (DDD, EEE)
    CCC = (ZZZ, GGG)
    DDD = (DDD, DDD)
    EEE = (EEE, EEE)
    GGG = (GGG, GGG)
    ZZZ = (ZZZ, ZZZ)
    txt;

const EXAMPLE_08b = <<<txt
    LLR

    AAA = (BBB, BBB)
    BBB = (AAA, ZZZ)
    ZZZ = (ZZZ, ZZZ)
    txt;

test('Part One: Example A', function () {
    $input = explode("\n", EXAMPLE_08a);
    $sys = new Day08($input);
    expect($sys->partOne())->toBe(2);
});

test('Part One: Example B', function () {
    $input = explode("\n", EXAMPLE_08b);
    $sys = new Day08($input);
    expect($sys->partOne())->toBe(6);
});

 test('Part One: Puzzle', function () {
     $input = file(at('TwentyThree/08.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day08($input);
     expect($sys->partOne())->toBe(12599);
 });

// test('Part Two: Example', function () {
//     $input = explode("\n", EXAMPLE_08);
//     $sys = new Day08($input);
//     expect($sys->partTwo())->toBe(0);
// });
//
// test('Part Two: Puzzle', function () {
//     $input = file(at('TwentyThree/08.txt'), FILE_IGNORE_NEW_LINES);
//     $sys = new Day08($input);
//     expect($sys->partTwo())->toBe(0);
// });
