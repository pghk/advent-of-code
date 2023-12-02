<?php

use App\TwentyThree\Day01;

const EXAMPLE_01 = <<<txt
    1abc2
    pqr3stu8vwx
    a1b2c3d4e5f
    treb7uchet
    txt;

const EXAMPLE_01_b = <<<txt
    two1nine
    eightwothree
    abcone2threexyz
    xtwone3four
    4nineeightseven2
    zoneight234
    7pqrstsixteen
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_01);
    $sys = new Day01($input);
    expect($sys->partOne())->toBe(142);
});

 test('Part One: Puzzle', function () {
     $input = file(at('TwentyThree/01.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day01($input);
     expect($sys->partOne())->toBe(54644);
 });

 test('Part Two: Example', function () {
     $input = explode("\n", EXAMPLE_01_b);
     $sys = new Day01($input);
     expect($sys->partTwo())->toBe(281);
 });

 test('Part Two: Puzzle', function () {
     $input = file(at('TwentyThree/01.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day01($input);
     expect($sys->partTwo())->toBe(53348);
 });
