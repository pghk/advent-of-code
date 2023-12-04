<?php

use App\TwentyThree\Day03;

// 668 939 417 335 1 37 544 27 751 225 891 380 45 11 839 622 476
const EXAMPLE_03 = <<<txt
    467..114..
    ...*......
    ..35..633.
    ......#...
    617*......
    .....+.58.
    ..592.....
    ......755.
    ...$.*....
    .664.598..
    txt;

test('Part One: Example', function () {
    $input = explode("\n", EXAMPLE_03);
    $sys = new Day03($input);
    expect($sys->partOne())->toBe(4361);
});

 test('Part One: Puzzle', function () {
     $input = file(at('TwentyThree/03.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day03($input);
     expect($sys->partOne())->toBe(546563);
 });

 test('Part Two: Example', function () {
     $input = explode("\n", EXAMPLE_03);
     $sys = new Day03($input);
     expect($sys->partTwo())->toBe(467835);
 });

 test('Part Two: Puzzle', function () {
     $input = file(at('TwentyThree/03.txt'), FILE_IGNORE_NEW_LINES);
     $sys = new Day03($input);
     expect($sys->partTwo())->toBe(91031374 );
 });
