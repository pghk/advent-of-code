<?php

use App\TwentyThree\Day02;

const EXAMPLE_02 = <<<txt
    Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
    Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
    Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
    Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
    Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_02);
    $sys = new Day02($input);
    expect($sys->partOne())->toBe(8);
});

 test('Part One: Puzzle', function () {
     $input = file(at('TwentyThree/02.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day02($input);
     expect($sys->partOne())->toBe(2377);
 });

 test('Part Two: Example', function () {
     $input = explode("\n", EXAMPLE_02);
     $sys = new Day02($input);
     expect($sys->partTwo())->toBe(2286);
 });

 test('Part Two: Puzzle', function () {
     $input = file(at('TwentyThree/02.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day02($input);
     expect($sys->partTwo())->toBe(71220);
 });
